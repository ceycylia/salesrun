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
        $data = $this->request->getPost(['name', 'description', 'timeline', 'status']);

        if ($this->productModel->insert($data)) {
            return redirect()->to('admin/master/product')->with('success', 'Produk berhasil disimpan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk');
    }

    public function update($id)
    {
        $data = $this->request->getRawInput();

        if ($this->productModel->update($id, $data)) {
            return redirect()->to('admin/master/product')->with('success', 'Produk berhasil diperbarui');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui produk');
    }

    public function delete($id)
    {
        if ($this->productModel->delete($id)) {
            return $this->respondDeleted(['message' => 'Produk berhasil dihapus']);
        }

        return $this->fail('Gagal menghapus produk');
    }
}
