<?php

namespace App\Models;

use App\Entities\Exercice;
use App\Traits\DataTableTrait;
use App\Traits\Select2Searchable;
use CodeIgniter\Model;

class ExerciceModel extends Model
{
    use DataTableTrait;
    use Select2Searchable;

    protected $table            = 'exercices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'description', 'rest_time', 'reps', 'nber_series', 'time_series', 'id_cat', 'id_muscle'
    ];

    protected $select2SearchableFields = ['name'];
    protected $select2DisplayField = 'name';


    public function getExerciceById(int $id): string
    {
        $exerciceModel = model('ExercicesModel');
        $exercice = $exerciceModel->find($id);
        return $exercice;
    }


    protected function getDataTableConfig(): array
    {
        return [
            'searchable_fields' => [
                'exercices.id', 'exercices.name', 'exercices.description',
                'exercices.rest_time', 'exercices.reps', 'exercices.nber_series', 'exercices.time_series',
                'categories.name', 'muscles.name'
            ],
            'joins' => [
                [
                    'table' => 'muscles',
                    'condition' => 'muscles.id = exercices.id_muscle',
                    'type' => 'left'
                ],
                [
                    'table' => 'categories',
                    'condition' => 'categories.id = exercices.id_cat',
                    'type' => 'left'
                ]
            ],
            'select' => '
            exercices.*,
            muscles.name as name_muscle,
            categories.name as name_cat,
            (
                (SELECT COUNT(*) FROM workout WHERE workout.id_exercices = exercices.id)
                +
                (SELECT COUNT(*) FROM series WHERE series.id_exercices = exercices.id)
            ) AS count_usage
        ',
            'with_deleted' => false,
        ];
    }
}
