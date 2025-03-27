<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitPipelineModel;
use App\Models\ActualModel;
use App\Services\DataTableService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class ClosingPipeline extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected VisitPipelineModel $visitPipelineModel;
    protected ActualModel $actualModel;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->visitPipelineModel = new VisitPipelineModel();
        $this->actualModel = new ActualModel();
    }

    public function index()
    {
        return $this->createForm();
    }

    public function createForm()
    {
        // Ambil nama nasabah (pipeline) yang sudah closing (status_closing = 1)
        $pipelines = $this->visitPipelineModel->getClosedPipelineCustomers();
        $productModel = new \App\Models\ProductModel(); // Pastikan model dipanggil
        $products = $productModel->getProductDropdown(); // Ambil produk aktif

        // Debugging: Cek apakah $products ada datanya
        if (empty($products)) {
            return "Produk tidak ditemukan!";
        }

        return view('pages/closing_pipeline/create', [
            'action' => base_url('pipeline/closing'),
            'pipelines' => $pipelines,
            'products' => $products // Kirim ke view
        ]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'pipeline_id'     => 'required|integer',
            'bank_code'       => 'required|string',
            'product_id'      => 'required|integer',
            'account_number'  => 'required|string',
            'actual'          => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'pipeline_id' => $this->request->getPost('pipeline_id'),
            'branch_code' => $this->request->getPost('bank_code'),
            'id_product' => $this->request->getPost('product_id'),
            'acc_number' => $this->request->getPost('account_number'),
            'actual' => $this->request->getPost('actual'),
            'timestamp' => date('Y-m-d H:i:s'),
            'month' => date('n'),
        ];

        $this->actualModel->insert($data);

        return redirect()->to('/pipeline/closing')->with('success', 'Data closing berhasil disimpan.');
    }
}
