<?php

namespace App\Models;

use App\Traits\DataTableTrait;
use App\Traits\Select2Searchable;
use CodeIgniter\Model;

class SeriesModel extends Model
{
    use DataTableTrait;
    use Select2Searchable;

    protected $table            = 'series';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_program", "id_exercices", "reps", "weight", "date"
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

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


    protected function getDataTableConfig(): array
    {
        return [
            'searchable_fields' => ['program.name', 'exercices_name', 'series.reps', 'series.weight', 'series.date'],
            'joins' => [
                [
                    'table' => 'program',
                    'condition' => 'program.id = series.id_program',
                    'type' => 'left'
                ],
                [
                    'table' => 'exercices',
                    'condition' => 'exercices.id = series.id_exercices',
                    'type' => 'left'
                ]
            ],
            'select' => 'series.*, exercices.name as name_exercices, program.name as name_program',
            'with_deleted' => false,
        ];
    }
}
