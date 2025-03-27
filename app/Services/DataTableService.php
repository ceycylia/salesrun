<?php

namespace App\Services;

use App\Libraries\DataTable;
use App\Models\ActualModel;
use App\Models\VisitPipelineModel;
use App\Models\PipelineModel;
use App\Models\ProductModel;
use App\Models\TargetModel;

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
            case 'actual':
                return $this->getActualTable();
            case 'target':
                return $this->getTargetTable();
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
                return format_tanggal($row['date_visit']);
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
                return format_tanggal($row['date_visit']);
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
                ['data' => 'id_product', 'title' => 'ID Product'],
                ['data' => 'name', 'title' => 'Nama Produk'],
                ['data' => 'description', 'title' => 'Deskripsi'],
                //  ['data' => 'timeline', 'title' => 'Timeline'],
                ['data' => 'status', 'title' => 'Status']


            ];
        }

        return (new DataTable(
            'productTable',
            base_url('admin/master/product/datatable'),
            $query,
            getProductColumns()
        ))
            // ->editColumn('timeline', function ($row) {
            //     return format_tanggal($row['timeline']); // Format tanggal biar enak dibaca
            // })
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

    // actual
    protected function getActualTable(): DataTable
    {
        $model = new ActualModel();
        $query = $model->getAllDataWithPipeline(); // nanti method ini lo tambahin di modelnya

        function getActualColumns()
        {
            return [
                ['data' => 'id', 'title' => 'ID'],
                ['data' => 'id_fso', 'title' => 'ID FSO'],
                ['data' => 'visitpipeline_id', 'title' => 'Nama Pipeline'],
                ['data' => 'branch_code', 'title' => 'Kode Bank'],
                ['data' => 'product_id', 'title' => 'ID Produk'],
                ['data' => 'acc_number', 'title' => 'Nomor Rekening'],
                ['data' => 'actual', 'title' => 'Aktual'],
                ['data' => 'month', 'title' => 'Bulan'],
                ['data' => 'timestamp', 'title' => 'Created At']
            ];
        }

        return (new DataTable(
            'actualTable',
            base_url('performance/actual/datatable'),
            $query,
            getActualColumns()
        ))
            ->editColumn('timestamp', function ($row) {
                return '<span class="badge bg-info">' . format_tanggal($row['timestamp']) . '</span>';
            })
            ->addColumn('actions', function ($row) {
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                return "<button class='btn btn-warning btn-sm' onclick='editActual({$rowJson})'>Edit</button>
                    <button class='btn btn-danger btn-sm' onclick='deleteActual({$rowJson})'>Delete</button>";
            })
            ->rawColumns(['timestamp', 'actions']);
    }

    protected function getTargetTable(): DataTable
    {
        $model = new TargetModel();
        $query = $model->findAll();

        function getTargetColumns()
        {
            return [
                ['data' => 'id', 'title' => 'ID'],
                ['data' => 'id_fso', 'title' => 'FSO ID'],
                ['data' => 'month', 'title' => 'Month'],
                ['data' => 'target', 'title' => 'Target'],
            ];
        }

        return (new DataTable(
            'targetTable',
            base_url('performance/target/datatable'),
            $query,
            getTargetColumns()
        ))
            ->editColumn('timestamp', function ($row) {
                return '<span class="badge bg-info">' . format_tanggal($row['timestamp']) . '</span>';
            })
            ->addColumn('actions', function ($row) {
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                return "<button class='btn btn-warning btn-sm' onclick='editTarget({$rowJson})'>Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='deleteTarget({$rowJson})'>Delete</button>";
            })
            ->rawColumns(['timestamp', 'actions']);
    }
}
