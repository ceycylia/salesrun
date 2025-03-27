<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActualModel;
use App\Models\ProductModel;
use App\Models\VisitPipelineModel;
use App\Services\DataTableService;
use CodeIgniter\API\ResponseTrait;

class Actual extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected ActualModel $actualModel;
    protected VisitPipelineModel $visitPipelineModel;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->actualModel = new ActualModel();
        $this->visitPipelineModel = new VisitPipelineModel();
    }

    // ✅ Tampilkan halaman index
    public function index()
    {
        $pages = ['title' => 'Actual Performance'];
        $dataTable = $this->dataTableService->getDataTable('actual');
        return view('pages/actual/index', compact('pages', 'dataTable'));
    }

    // ✅ Return JSON data untuk DataTables
    public function actualData()
    {
        return $this->response->setJSON(
            $this->dataTableService->getDataTable('actual')->generateJson()
        );
    }

    // ✅ Tampilkan form input actual
    public function createForm()
    {
        $pipelines = $this->visitPipelineModel->getClosedPipelineCustomers();
        $productModel = new ProductModel();
        $products = $productModel->getProductDropdown();

        return view('pages/actual/form', [
            'action'    => '/actual/store',
            'pipelines' => $pipelines,
            'products'  => $products
        ]);
    }

    // ✅ Simpan data actual
    public function store()
    {
        $data = [
            'id_fso'          => $this->request->getPost(''), // Ambil dari pipeline
            'visitpipeline_id'=> $this->request->getPost('visitpipeline_id'), // simpan juga ID-nya
            'branch_code'     => $this->request->getPost('bank_code'),
            'product_id'      => $this->request->getPost('product_id'),
            'acc_number'      => $this->request->getPost('account_number'),
            'actual'          => $this->request->getPost('actual'),
            'month'           => date('n'), // disesuaikan dgn format DB (int)
            'timestamp'       => date('Y-m-d H:i:s'),
        ];
        
        if ($this->actualModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data actual berhasil disimpan!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data actual.'
            ]);
        }
    }
    
}
