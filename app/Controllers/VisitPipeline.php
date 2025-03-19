<?php

namespace App\Controllers;

use App\Models\PipelineModel;
use App\Models\VisitPipelineModel;
use App\Services\DataTableService;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Request;

use function PHPUnit\Framework\throwException;

class VisitPipeline extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected PipelineModel $pipelineModel;
    protected VisitPipelineModel $visitPipelineModel;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->pipelineModel = new PipelineModel();
        $this->visitPipelineModel = new VisitPipelineModel();
    }

    public function index()
    {
        $pages = ['title' => 'Visit Pipeline'];
        $dataTable = $this->dataTableService->getDataTable('visitPipeline');
        return view('pages/visit_pipeline/index', compact('pages', 'dataTable'));
    }

    public function createForm()
    {
        $pipelines = $this->pipelineModel->select('id, name')->findAll();

        $productModel = new \App\Models\ProductModel(); // Pastikan model dipanggil
        $products = $productModel->getProductDropdown(); // Ambil produk aktif

        // Debugging: Cek apakah $products ada datanya
        if (empty($products)) {
            return "Produk tidak ditemukan!";
        }

        // dd($products);
        return view('pages/visit_pipeline/form', [
            'action' => base_url('/pipeline/visit/store'),
            'pipelines' => $pipelines,
            'products' => $products // Kirim ke view
        ]);
    }

    public function editForm($id)
    {
        $data = $this->visitPipelineModel->find($id);
        $productModel = new \App\Models\ProductModel(); // Pastikan model dipanggil
        $products = $productModel->getProductDropdown(); // Ambil produk aktif
        $pipelines = $this->pipelineModel->select('id, name')->findAll();

        return view('pages/visit_pipeline/form', [
            'action' => 'pipeline/visit/update/' . $id,
            'data' => $data,
            'pipelines' => $pipelines,

            'products' => $products // Kirim ke view

        ]);
    }


    // Fetch semua pipeline untuk dropdown
    public function getPipelines()
    {
        $data = $this->pipelineModel->select('id, name')->findAll();
        return $this->response->setJSON($data);
    }

    // Fetch potential & address berdasarkan pipeline_id
    public function getPipelineDetails($id)
    {
        if (!is_numeric($id)) {
            return $this->response->setJSON(['error' => 'Invalid ID'], 400);
        }

        $pipeline = $this->pipelineModel
            ->select('id, name, potential, address')
            ->where('id', $id)
            ->first();

        if (!$pipeline) {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan'], 404);
        }

        return $this->response->setJSON([
            'id' => $pipeline['id'],
            'name' => $pipeline['name'],
            'potential' => $pipeline['potential'] ?? 'Data tidak tersedia',
            'address' => $pipeline['address'] ?? 'Data tidak tersedia'
        ]);
    }

    // ✅ Return data untuk DataTables
    public function visitPipelineData()
    {
        return $this->response->setJSON($this->dataTableService->getDataTable('visitPipeline')->generateJson());
    }

    // ✅ Simpan data visit pipeline baru
    public function store()
    {
        $pipeline_id = $this->request->getPost('pipeline_id');

        // Validasi pipeline ID
        $pipelineExists = $this->pipelineModel->where('id', $pipeline_id)->first();

        if (!$pipelineExists) {
            return redirect()->back()->withInput()->with('error', 'Pipeline ID tidak valid!');
        }

        $data = [
            'pipeline_id'       => $pipeline_id,
            'date_visit'        => $this->request->getPost('date_visit'),
            'location_visit'    => $this->request->getPost('location_visit'),
            'product_potential' => $this->request->getPost('product_potential'),
            'product_id'        => $this->request->getPost('product_id'),
            'prospect_visit'    => $this->request->getPost('prospect_visit'),
            'closing_plan'      => $this->request->getPost('closing_plan'),
            'status'            => $this->request->getPost('status'),
            'coment'            => $this->request->getPost('coment'),
            'status_closing'    => (int) $this->request->getPost('status_closing'),

        ];

        if ($this->visitPipelineModel->save($data)) {
            return redirect()->to('/pipeline/visit')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
        }
    }
}
