<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualModel extends Model
{
    protected $table            = 'actual';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'id_fso',
        'visitpipeline_id',
        'branch_code',
        'product_id', // FIX: 'id_product' diganti jadi 'product_id' biar sesuai database
        'acc_number',
        'actual',
        'timestamp',
        'month'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    public function getAllDataWithPipeline()
    {
        return $this->select([
            'actual.id',
            'actual.id_fso',
            'visit_pipelines.id AS visitpipeline_id',
            'pipelines.name AS pipeline_name',
            'actual.branch_code',
            'actual.product_id',
            'actual.acc_number',
            'actual.actual',
            'actual.month',
            'actual.timestamp'
        ])
            ->join('visit_pipelines', 'visit_pipelines.id = actual.visitpipeline_id', 'left')
            ->join('pipelines', 'pipelines.id = visit_pipelines.pipeline_id', 'left')
            ->where('visit_pipelines.status_closing', 1) // ✅ Tambahkan kondisi status = 1
            ->findAll();
    }
}
// closing apa visit? itu visit id
// ginii, di closing pipeline kan ada form, dia manggil nama nasabah yang status closingnya = 1 di visit pipeline
// nanti setelah form itu di submit dia nampilin datanya di halaman performance/actual