<?php

namespace App\Controllers;

use App\Models\TargetModel;
use App\Services\DataTableService;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Target extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected TargetModel $targetModel;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->targetModel = new TargetModel();
    }

    public function index()
    {
        $pages = ['title' => 'Target'];
        $dataTable = $this->dataTableService->getDataTable('target');
        return view('pages/target/index', compact('pages', 'dataTable'));
    }

    public function targetData() // ini nama method nya  bukan Data
    {
        return $this->response->setJSON(
            $this->dataTableService->getDataTable('target')->generateJson()
        );
    }

    public function create()
    {
        return view('pages/target/form', [ // udaa masuk kan? udaa
            'action' => 'performance/target/store',
            'type' => 'create'
        ]);
    }

    public function edit($id)
    {
        $data = $this->targetModel->find($id);

        if (!$data) {
            return redirect()->to('/target')->with('error', 'Data tidak ditemukan');
        }

        return view('pages/target/create', [
            'action' => 'target/update/' . $id,
            'type' => 'update',
            'data' => $data
        ]);
    }

    public function store()
    {
        $data = [
            'id_fso'  => $this->request->getPost('id_fso'),
            'target'  => $this->request->getPost('target'),
            'month'   => $this->request->getPost('month'),
        ];

        if ($this->targetModel->save($data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Gagal menambahkan data']);
        }
    }

    public function update($id)
    {
        $data = [
            'id_fso'  => $this->request->getPost('id_fso'),
            'target'  => $this->request->getPost('target'),
            'month'   => $this->request->getPost('month'),
        ];

        if ($this->targetModel->update($id, $data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Gagal memperbarui data']);
        }
    }

    public function delete($id)
    {
        if ($this->targetModel->delete($id)) {
            return $this->respond(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }
}
