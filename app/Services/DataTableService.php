<?php

namespace App\Services;

use App\Libraries\DataTable;
use App\Models\VisitPipelineModel;
use App\Models\PipelineModel;
use App\Models\ProductModel;

class DataTableService
{
    public function getDataTable(string $tableName): ?DataTable
    {
        switch ($tableName) {
            case 'pipeline': // Menambahkan case pipeline
                return $this->getPipelineTable();
            case 'visitPipeline':
                return $this->getVisitPipelineTable();
            case 'closingPipeline':
                return $this->getClosingPipelineTable();
            case 'product': // Menambahkan case product
                return $this->getProductTable();
            default:
                return null;
        }
    }

    // Pipeline Table
    protected function getPipelineTable(): DataTable
    {
        $model = new PipelineModel();
        $query = $model->findAll();

        function getPipelineColumns()
        {
            return [
                ['data' => 'id', 'title' => 'ID'],
                ['data' => 'name', 'title' => 'Name'],
                ['data' => 'potential', 'title' => 'Potential'],
                ['data' => 'address', 'title' => 'Address'],
                ['data' => 'address_note', 'title' => 'Address_note'],
                ['data' => 'job', 'title' => 'Job'],
                ['data' => 'exiting_pipelines', 'title' => 'Existing Pipelines']
            ];
        }

        return (new DataTable(
            'pipelineTable',
            base_url('pipeline/datatable'), // URL ada ngga?
            $query,
            getPipelineColumns()
        ))
            // Edit Table itu untuk ngubah tampilan dari DB ke Fe misal O/1 jadi Yes/No atau apapun
            ->editColumn('exiting_pipelines', function ($row) {
                return $row['exiting_pipelines'] == 1
                    ? '<span class="badge bg-success">Existing</span>'
                    : '<span class="badge bg-warning">New</span>';
            })
            // Add Column berarti nambahin kolom selain yang dari data DB
            ->addColumn('actions', function ($row) {
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); // Escape agar aman di HTML


                return "<button class='btn btn-warning btn-sm' onclick='editPipeline({$rowJson})' >Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='deletePipeline({$rowJson})' >Delete</button>";
            })
            // Raw berarti dipanggilnya html format
            ->rawColumns(['actions', 'exiting_pipelines']);
    }

    protected function getVisitPipelineTable(): DataTable
    {
        $model = new VisitPipelineModel();
        $query = $model->getAllDataWithPipeline();

        function getVisitColumns()
        {
            return [
                ['data' => 'id', 'title' => 'ID'],
                ['data' => 'pipeline_name', 'title' => 'Pipeline Name'],
                ['data' => 'location_visit', 'title' => 'Location Visit'],
                ['data' => 'date_visit', 'title' => 'Tanggal Visit'],
                ['data' => 'product_potential', 'title' => 'Product Potential'],
                ['data' => 'prospect_visit', 'title' => 'Prospect Visit'],
                ['data' => 'closing_plan', 'title' => 'Closing Plan'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'coment', 'title' => 'Testimoni'],
                ['data' => 'status_closing', 'title' => 'Status Closing']
            ];
        }

        return (new DataTable(
            'visitPipelineTable',
            base_url('pipeline/visit/datatable'),
            $query,
            getVisitColumns()
        ))
            ->editColumn('status_closing', function ($row) {
                return $row['status_closing'] == 1
                    ? '<span class="badge bg-success">Ya</span>'
                    : '<span class="badge bg-warning">Tidak</span>';
            })
            ->editColumn('date_visit', function ($row) {
                return format_tanggal_carbon($row['date_visit']);
            })
            ->addColumn('actions', function ($row) {
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                return "<button class='btn btn-warning btn-sm' onclick='editItem({$rowJson})'>Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='deleteItem({$rowJson})'>Delete</button>";
            })
            ->rawColumns(['status_closing', 'actions']);
    }

    protected function getClosingPipelineTable(): DataTable
    {
        $model = new VisitPipelineModel();
        $query = $model->getAllDataWithPipeline();

        function getClosingColumns()
        {
            return [
                ['data' => 'id', 'title' => 'ID'],
                ['data' => 'pipeline_name', 'title' => 'Pipeline Name'],
                ['data' => 'status_closing', 'title' => 'Status Closing']
            ];
        }

        return (new DataTable(
            'visitPipelineTable',
            base_url('pipeline/visit/datatable'),
            $query,
            getClosingColumns()
        ))
            ->editColumn('status_closing', function ($row) {
                return $row['status_closing'] == 1
                    ? '<span class="badge bg-success">Closed</span>'
                    : '<span class="badge bg-warning">Open</span>';
            })
            ->editColumn('date_visit', function ($row) {
                return format_tanggal_carbon($row['date_visit']);
            })
            ->addColumn('actions', function ($row) {
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                return "<button class='btn btn-warning btn-sm' onclick='editItem({$rowJson})'>Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='deleteItem({$rowJson})'>Delete</button>";
            })
            ->rawColumns(['status_closing', 'actions']);
    }

    // Product Table
    protected function getProductTable(): DataTable
    {
        $model = new ProductModel();
        $query = $model->findAll();

        function getProductColumns()
        {
            return [
                ['data' => 'id', 'title' => 'ID'],
                ['data' => 'name', 'title' => 'Nama Produk'],
                ['data' => 'description', 'title' => 'Deskripsi'],
                ['data' => 'timeline', 'title' => 'Timeline'],
                ['data' => 'status', 'title' => 'Status']
            ];
        }

        return (new DataTable(
            'productTable',
            base_url('admin/master/product/datatable'),
            $query,
            getProductColumns()
        ))
            ->editColumn('timeline', function ($row) {
                return format_tanggal_carbon($row['timeline']); // Format tanggal biar enak dibaca
            })
            ->editColumn('status', function ($row) {
                return $row['status'] == 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('actions', function ($row) {
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $statusLabel = $row['status'] == 1 ? 'Nonaktifkan' : 'Aktifkan';
                $statusClass = $row['status'] == 1 ? 'btn-danger' : 'btn-success';

                return "<button class='btn btn-warning btn-sm' onclick='editProduct({$rowJson})'>Edit</button>
                    <button class='btn btn-danger btn-sm' onclick='deleteProduct({$rowJson})'>Delete</button>";
            })
            ->rawColumns(['actions', 'status']);
    }
}
