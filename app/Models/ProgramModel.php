<?php

namespace App\Models;

use App\Traits\DataTableTrait;
use CodeIgniter\Model;

class ProgramModel extends Model
{
    use DataTableTrait;
    protected $table            = 'program';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'id_user', 'id_cat'];
    protected $useTimestamps = false;
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
    protected $beforeDelete = ['deleteRelatedWorkoutsAndSeries'];
    protected $afterDelete    = [];

    public function getProgram($id) : array {
        return
            $this
                ->select('program.*, u.username as creator_name, c.name as cat_name' )
                ->join('user u', 'program.id_user = u.id', 'left')
                ->join('category_prgm c', 'c.id = program.id_cat', 'left')
                ->where('program.id', $id)
                ->first();
    }

    protected function getDataTableConfig(): array
    {
        return [
            'searchable_fields' => [
                'program.id',
                'program.name',
                'user.username',
                'category_prgm.name'
            ],
            'joins' => [
                [
                    'table' => 'user',
                    'condition' => 'program.id_user = user.id',
                    'type' => 'left'
                ],
                [
                    'table' => 'categories_prgm',
                    'condition' => 'categories_prgm.id = program.id_cat',
                    'type' => 'left'
                ]
            ],
            'select' => 'program.id, program.name, user.username as creator_name, categories_prgm.name as cat_name, 
            (
                (SELECT COUNT(*) FROM workout WHERE workout.id_program = program .id)
                +
                (SELECT COUNT(*) FROM series WHERE series.id_program  = program .id)
            ) AS count_usage'


        ];
    }

    protected function deleteRelatedWorkoutsAndSeries(array $data)
    {
        $builderWorkout = $this->db->table('workout');
        $builderSeries = $this->db->table('series');

        // $data['ids'] contient les IDs qui vont être supprimés
        $ids = is_array($data['id']) ? $data['id'] : [$data['id']];

        if (!empty($ids)) {
            // Supprimer les series liées
            $builderSeries->whereIn('id_program', $ids)->delete();

            // Supprimer les workouts liés
            $builderWorkout->whereIn('id_program', $ids)->delete();
        }
    }
}
