<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitPipelineModel extends Model
{
    protected $table            = 'visit_pipelines';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'pipeline_id',
        'date_visit',
        'location_visit',
        'product_id',
        'prospect_visit',
        'closing_plan',
        'status',
        'coment',
        'status_closing'
    ];  // Sesuaiin sama field lain di tabel visit_pipeline
    // ci coba input lagi data
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    // Ambil semua data visit dengan join ke pipeline
    public function getAllDataWithPipeline()
    {
        return $this->select('visit_pipelines.*, pipelines.name as pipeline_name, products.name as product_potential')
            ->join('pipelines', 'pipelines.id = visit_pipelines.pipeline_id')
            ->join('products', 'products.id = visit_pipelines.product_id', 'left') // Benar
            ->findAll();
    }

    // ✅ Function buat ambil ID & Nama Nasabah dari tabel pipelines
    public function getPipelines()
    {
        return $this->db->table('pipelines')
            ->select('id, name, potential, address')
            ->get()
            ->getResult();
    }

    // ✅ Ambil detail nasabah berdasarkan pipeline_id yang dipilih
    public function getPipelineDetailsById($id)
    {
        return $this->db->table('pipelines')
            ->select('potential, address')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }
    
    // ✅ Ambil semua pipeline dengan status closing = 1 (untuk nama nasabah di closing)
    public function getClosedPipelineCustomers()
    {
        return $this->db->table('visit_pipelines')
            ->select('pipelines.id, pipelines.name')
            ->join('pipelines', 'pipelines.id = visit_pipelines.pipeline_id')
            ->where('visit_pipelines.status_closing', 1)
            ->groupBy('pipelines.id, pipelines.name') // Hindari duplikat
            ->get()
            ->getResultArray();
    }
}
