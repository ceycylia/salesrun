<?php

namespace App\Libraries;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;
use Closure;

class DataTable
{
    protected string $id;
    protected string $url;
    protected array $columns = [];
    protected array $options = [];
    protected $query;
    protected array $customColumns = [];
    protected array $rawColumns = [];

    public function __construct(string $id, string $url, $query, array $columns = [], array $options = [])
    {
        $this->id = $id;
        $this->url = $url;
        $this->query = $query;
        $this->columns = $columns ?: $this->detectColumns();
        $this->options = array_merge([
            'processing' => true,
            'serverSide' => true,
            'searching' => true,
            'paging' => true,
            'ordering' => true,
        ], $options);
    }

    protected function detectColumns(): array
    {
        // if ($this->query instanceof BaseBuilder) {
        //     return array_keys($this->query->get()->getRowArray() ?? []);
        // } elseif ($this->query instanceof Model) {
        //     return $this->query->db->getFieldNames($this->query->table);
        // }
        // return [];
        return $this->query->countAllResults() > 0 ? array_keys($this->query->get()->getRowArray() ?? []) : [];
    }

    public function editColumn(string $name, Closure $callback): self
    {
        $this->customColumns[$name] = $callback;
        return $this;
    }

    public function addColumn(string $name, Closure $callback): self
    {
        $this->customColumns[$name] = $callback;

        // Cek apakah kolom sudah ada sebelum menambahkannya
        if (!in_array($name, array_column($this->columns, 'data'))) {
            $this->columns[] = ['data' => $name, 'title' => ucfirst(str_replace('_', ' ', $name))];
        }

        return $this;
    }


    public function rawColumns(array $columns): self
    {
        $this->rawColumns = array_merge($this->rawColumns, $columns);
        return $this;
    }

    public function generateJson()
    {
        $request = service('request');
        $start = (int) $request->getGet('start', FILTER_SANITIZE_NUMBER_INT);
        $length = (int) $request->getGet('length', FILTER_SANITIZE_NUMBER_INT);
        $search = $request->getGet('search');
        $searchValue = is_array($search) && isset($search['value']) ? trim($search['value']) : '';

        $query = $this->query;

        // Pastikan query bisa dieksekusi

        // Pastikan query bisa dieksekusi
        if ($query instanceof BaseBuilder) {
            // Handle Search
            if ($searchValue) {
                $query->groupStart();
                foreach ($this->columns as $col) {
                    $query->orLike($col, $searchValue);
                }
                $query->groupEnd();
            }

            // Handle Pagination
            if ($length > 0) {
                $query->limit($length, $start);
            }

            $data = $query->get()->getResultArray();
            $totalRecords = $query->countAllResults(); // Hitung total data

        } elseif ($query instanceof Model) {
            // Handle Search
            if ($searchValue) {
                foreach ($this->columns as $col) {
                    $query = $query->orLike($col, $searchValue);
                }
            }

            // Handle Pagination
            $data = $query->findAll($length, $start);
            $totalRecords = $query->countAllResults();
        } elseif (is_array($query)) {
            // Jika $query berupa array, handle pencarian manual
            if ($searchValue) {
                $query = array_filter($query, function ($row) use ($searchValue) {
                    foreach ($this->columns as $col) {
                        // Perbaikan: Pastikan kita mendapatkan string nama kolom
                        $columnName = is_array($col) ? ($col['data'] ?? '') : $col; // disini

                        if ($columnName && isset($row[$columnName]) && stripos($row[$columnName], $searchValue) !== false) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $totalRecords = count($query);
            $data = array_slice($query, $start, $length);
        } else {
            throw new \Exception("Query harus berupa BaseBuilder, Model, atau Array.");
        }


        foreach ($data as &$row) {
            foreach ($this->customColumns as $col => $callback) {
                $row[$col] = is_callable($callback) ? $callback($row) : $callback;
            }
        }

        foreach ($data as &$row) {
            foreach ($this->rawColumns as $col) {
                if (isset($row[$col])) {
                    $row[$col] = htmlspecialchars_decode($row[$col], ENT_QUOTES);
                }
            }
        }

        return json_encode([
            'draw' => (int) $request->getGet('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => array_values($data)
        ]);
    }

    public function renderHtml(): string
    {
        $thead = '<thead><tr>';
        foreach ($this->columns as $column) {
            $data = $column['data'] ?? '';
            $title = $column['title'] ?? $data;
            $thead .= "<th id='column-{$data}'>{$title}</th>";
        }
        $thead .= '</tr></thead>';
        return "<table id='{$this->id}' class='table table-striped'>{$thead}</table>";
    }


    public function renderScript(): string
    {
        $columns = [];
        $columnDefs = [];
        $index = 0;

        foreach ($this->columns as $column) {
            $data = $column['data'] ?? '';
            $title = $column['title'] ?? $data;

            $columns[] = ['data' => $data, 'title' => $title];

            // Jika ada custom render untuk kolom ini
            if (isset($this->customColumns[$data])) {
                $columnDefs[] = [
                    'targets' => $index,
                    'data' => $data,
                    'render' => "function(data, type, row) { return row['{$data}'] ?? ''; }"
                ];
            }
            $index++;
        }

        // Convert `columns` & `options` menggunakan json_encode()
        $columnsJs = json_encode($columns, JSON_UNESCAPED_SLASHES);
        $optionsJs = json_encode($this->options, JSON_UNESCAPED_SLASHES);

        // Buat `columnDefsJs` secara manual agar fungsi `render` tetap JavaScript
        $columnDefsJsArray = [];
        foreach ($columnDefs as $def) {
            $columnDefsJsArray[] = "{ targets: {$def['targets']}, data: '{$def['data']}', render: {$def['render']} }";
        }

        $columnDefsJs = '[' . implode(',', $columnDefsJsArray) . ']';

        return "<script>
            $(document).ready(function () {
                $('#{$this->id}').DataTable({
                    ajax: '{$this->url}',
                    columns: {$columnsJs},
                    columnDefs: {$columnDefsJs},
                    ...{$optionsJs}
                });
            });
        </script>";
    }


    public function render(): string
    {
        return $this->renderHtml() . $this->renderScript();
    }
}
