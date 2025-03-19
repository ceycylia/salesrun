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
        if ($this->query instanceof BaseBuilder) {
            return array_keys($this->query->get()->getRowArray() ?? []);
        } elseif ($this->query instanceof Model) {
            return $this->query->db->getFieldNames($this->query->table);
        }
        return [];
    }

    public function addColumn(string $name, Closure $callback): self
    {
        $this->customColumns[$name] = $callback;
        return $this;
    }

    public function editColumn(string $name, Closure $callback): self
    {
        $this->customColumns[$name] = $callback;
        return $this;
    }

    public function renderColumn(string ...$names): self
    {
        $this->rawColumns = array_merge($this->rawColumns, $names);
        return $this;
    }

    public function generateJson()
    {
        $request = service('request');
        $start = (int) $request->getGet('start', FILTER_SANITIZE_NUMBER_INT);
        $length = (int) $request->getGet('length', FILTER_SANITIZE_NUMBER_INT);
        $searchValue = trim($request->getGet('search')['value'] ?? '');
        $order = $request->getGet('order')[0] ?? null;

        $query = clone $this->query;

        // Search filter
        if ($searchValue) {
            $query->groupStart();
            foreach ($this->columns as $col) {
                $query->orLike($col, $searchValue);
            }
            $query->groupEnd();
        }

        // Ordering
        if ($order) {
            $columnIndex = (int) $order['column'];
            $columnName = array_keys($this->columns)[$columnIndex] ?? null;
            $direction = strtoupper($order['dir']) === 'DESC' ? 'DESC' : 'ASC';

            if ($columnName) {
                $query->orderBy($columnName, $direction);
            }
        }

        // Total records
        $totalRecords = $query->countAllResults(false);

        // Get paginated data
        $data = $query->limit($length, $start)->get()->getResultArray();

        // Apply custom columns
        foreach ($data as &$row) {
            foreach ($this->customColumns as $col => $callback) {
                $row[$col] = $callback($row);
            }
        }

        return [
            'draw' => (int) $request->getGet('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $searchValue ? count($data) : $totalRecords,
            'data' => $data
        ];
    }

    public function renderHtml(): string
    {
        $thead = '<thead><tr>';
        foreach ($this->columns as $key => $label) {
            $thead .= "<th>{$label}</th>";
        }
        $thead .= '</tr></thead>';

        return "<table id='{$this->id}' class='table table-striped'>{$thead}</table>";
    }

    public function renderScript(): string
    {
        $columnsJs = json_encode(array_map(fn($col) => [
            'data' => $col,
            'render' => in_array($col, $this->rawColumns) ? 'function(data, type, row) { return data; }' : null
        ], array_keys($this->columns)), JSON_UNESCAPED_SLASHES);

        $optionsJs = json_encode($this->options, JSON_UNESCAPED_SLASHES);

        return "<script>
            $(document).ready(function () {
                $('#{$this->id}').DataTable({
                    ajax: '{$this->url}',
                    columns: {$columnsJs},
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
