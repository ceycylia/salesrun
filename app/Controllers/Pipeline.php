<?php

namespace App\Controllers;

use App\Models\PipelineModel;
use App\Services\DataTableService;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Request;

use function PHPUnit\Framework\throwException;

class Pipeline extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected PipelineModel $pipelineModel;
    protected $session;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->pipelineModel = new PipelineModel();
        $this->session = session();
    }

    public function index()
    {
        $pages = ['title' => 'Pipeline'];
        $dataTable = $this->dataTableService->getDataTable('pipeline');
        return view('pages/pipeline/index', compact('pages', 'dataTable'));
    }

    public function create()
    {
        return view('pages/pipeline/form', [
            'action' => 'pipeline/store',
            'type' => 'create'
        ]);
    }
    public function edit($id)
    {
        $data = $this->pipelineModel->find($id);

        return view('pages/pipeline/form', [
            'action' => 'pipeline/update/' . $id,
            'type' => 'update',
            'data' => $data
        ]);
    }

    // Return data untuk DataTables
    public function pipelineData()
    {
        return $this->response->setJSON($this->dataTableService->getDataTable('pipeline')->generateJson());
    }

    // Simpan data pipeline baru
    public function store()
    {
        $data = [
            'name'              => $this->request->getPost('name'),
            'potential'         => $this->request->getPost('potential'),
            'address'           => $this->request->getPost('street') . ', ' .
                $this->request->getPost('district') . ', ' .
                $this->request->getPost('village') . ', ' .
                $this->request->getPost('city'),
            'address_note'      => $this->request->getPost('address_note'),
            'job'               => $this->request->getPost('job'),
            'exiting_pipelines' => $this->request->getPost('exiting_pipelines'),
        ];

        // if ($this->pipelineModel->save($data)) {
        //     return redirect()->to('/pipeline')->with('success', 'Data pipeline berhasil disimpan!');
        // } else {
        //     return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pipeline.');
        // }

        if ($this->pipelineModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data.'
            ]);
        }
    }

    // Update data
    public function update($id)
    {
        // Validasi Input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'potential' => 'required|numeric',
            'street' => 'required',
            'district' => 'required',
            'village' => 'required',
            'city' => 'required',
            'job' => 'required',
            'exiting_pipelines' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form POST
        $data = [
            'name' => $this->request->getPost('name'),
            'potential' => str_replace('.', '', $this->request->getPost('potential')), // Hilangkan titik
            'address' => $this->request->getPost('street') . ', ' .
                $this->request->getPost('district') . ', ' .
                $this->request->getPost('village') . ', ' .
                $this->request->getPost('city'),
            'address_note' => $this->request->getPost('address_note'),
            'job' => $this->request->getPost('job'),
            'exiting_pipelines' => $this->request->getPost('exiting_pipelines'),
        ];

        // Update data ke database
        // if ($this->pipelineModel->update($id, $data)) {
        //     $this->session->setFlashdata('success', 'Data berhasil diperbarui');
        // } else {
        //     $this->session->setFlashdata('error', 'Gagal memperbarui data');
        // }

        // return redirect()->to('/pipeline');


        if ($this->pipelineModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data.'
            ]);
        }
    }

    // Delete Data
    public function delete($id)
    {
        // Cek apakah data ada di database
        $pipeline = $this->pipelineModel->find($id);
        if (!$pipeline) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }

        // Hapus data
        if ($this->pipelineModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }
}
