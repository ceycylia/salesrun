<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PipelineModel;
use App\Services\DataTableService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class ClosingPipeline extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected PipelineModel $pipelineModel;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->pipelineModel = new PipelineModel();
    }

    public function index()
    {
        $pages = ['title' => 'Closing Pipeline'];
        $dataTable = $this->dataTableService->getDataTable('closingPipeline');
        return view('pages/closing_pipeline/index', compact('pages', 'dataTable'));
    }

    public function createForm()
    {
        $pipelines = $this->pipelineModel->select('id, name')->findAll();  // Fetch ID & Nama Pipeline
        return view('pages/closing_pipeline/create', [
            'action' => base_url('pipeline/visit'),
            'pipelines' => $pipelines
        ]);
    }

    // Fetch data pipelines buat dropdown (AJAX)
    public function getPipelines()
    {
        return $this->response->setJSON($this->pipelineModel->select('id, name')->findAll());
    }

    // Return data untuk DataTables
    public function visitPipelineData()
    {
        return $this->response->setJSON($this->dataTableService->getDataTable('visitPipeline')->generateJson());
    }

    // Simpan data visit pipeline baru
    public function store()
    {
        echo "ini untuk store";
    }
}
