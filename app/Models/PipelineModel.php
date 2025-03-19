<?php

namespace App\Models;

use CodeIgniter\Model;

class PipelineModel extends Model
{
    protected $table            = 'pipelines';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 
        'potential', 
        'address', 
        'address_note', 
        'job', 
        'exiting_pipelines'
    ];   // Pastikan ini sesuai dengan tabel di database

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

    // Construct
    public function __construct()
    {
        parent::__construct();
    }

    // ✅ Ambil semua data pipeline
    public function getAllPipelines()
    {
        return $this->select('id, name, potential, address, address_note, job, exiting_pipelines')
            ->findAll();
    }

    // ✅ Tambahin function baru buat ambil ID & Name doang
    public function getPipelines()
    {
        return $this->select('id, name')->findAll();  // Ganti pipeline_name jadi name

    }
}
