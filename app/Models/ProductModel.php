<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // ✅ Tambahkan kolom yang bisa diisi
    protected $allowedFields    = ['name', 'description', 'timeline', 'created_by', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // ✅ Perbaiki penggunaan timestamps
    protected $useTimestamps = true;  // Mengaktifkan otomatisasi waktu
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // ✅ Ambil semua produk (hanya yang aktif)
    public function getAllProducts()
    {
        return $this->select('id, name, description, timeline, created_by, status')
            ->where('status', 1)  // Hanya produk aktif
            ->orderBy('name', 'ASC')  // Urutkan berdasarkan nama
            ->findAll();
    }

    // ✅ Ambil produk untuk dropdown (ID & Nama saja)
    public function getProductDropdown()
    {
        return $this->select('id, name')
            ->where('status', 1)  // Hanya produk aktif
            ->orderBy('name', 'ASC')
            ->findAll();
    }
}
