<?php

namespace App\Models;

use App\Traits\DataTableTrait;
use App\Traits\Select2Searchable;
use CodeIgniter\Model;

class WorkoutModel extends Model
{
    use Select2Searchable;
    use DataTableTrait;

    protected $table            = 'workout';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["id_exercices", "id_program", "date", "rest_time", "order"];

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
            'searchable_fields' => ['exercices.name', 'program.name', "workout.date", "workout.rest_time", "workout.order"],
            'joins' => [
                [
                    'table' => 'exercices',
                    'condition' => 'exercices.id = workout.id_exercices',
                    'type' => 'left'
                ],
                [
                    'table' => 'program',
                    'condition' => 'program.id = workout.id_program',
                    'type' => 'left'
                ]
            ],
            'select' => 'workout.*, exercices.name as name_exercice, program.name as name_program',
            'with_deleted' => false,
        ];
    }
}
