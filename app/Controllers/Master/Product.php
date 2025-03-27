<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AddProductModel;
use App\Models\ProductModel;
use App\Services\DataTableService;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
    use ResponseTrait;

    protected DataTableService $dataTableService;
    protected ProductModel $productModel;
    protected $session;

    public function __construct()
    {
        $this->dataTableService = new DataTableService();
        $this->productModel = new ProductModel();
        $this->session = session();
    }

    public function index()
    {
        $dataTable = $this->dataTableService->getDataTable('product');

        $pages = [
            'title' => 'Master Product',
            'dataTable' => $dataTable
        ];

        return view('pages/master/product/index', $pages);
    }

    public function productData()
    {
        $dataTable = $this->dataTableService->getDataTable('product');

        if (!$dataTable) {
            return $this->failNotFound('Data produk tidak ditemukan');
        }

        return $this->response->setJSON($dataTable->generateJson());
    }

    public function create()
    {
        $data = [
            'action' => base_url('admin/master/product/store'),
            'id' => '',
            'name' => '',
            'description' => '',
            'timeline' => '',
            'status' => 1,
        ];

        return view('pages/master/product/form', $data);
    }

    public function edit($id)
    {
        $data = $this->productModel->find($id);
        if (!$data) {
            return redirect()->to('admin/master/product')->with('error', 'Produk tidak ditemukan');
        }

        $props = [
            'action' => base_url('admin/master/product/update/' . $id),
            'data' => $data,
        ];

        return view('pages/master/product/form', $props);
    }

    public function store()
    {
        $productModel = new ProductModel();
    
        $data = [
            'id_product' => $this->request->getPost('id_product'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'created_by' => session('user_id'),
            'status' => $this->request->getPost('status'),
        ];
    
        if ($productModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil ditambahkan']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menambahkan produk']);
        }
    }
    

    public function update($id)
{
    $productModel = new ProductModel();

    $data = [
        'id_product' => $this->request->getPost('id_product'),
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'status' => $this->request->getPost('status'),
    ];

        if ($productModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui produk']);
        }
    }

    public function delete($id)
    {
        $productModel = new ProductModel();

        if ($productModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus produk']);
        }
    }
}
