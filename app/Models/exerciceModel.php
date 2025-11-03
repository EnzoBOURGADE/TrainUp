<?php

namespace App\Models;

use App\Entities\Exercice;
use CodeIgniter\Model;

class ExerciceModel extends Model
{
    protected $table            = 'exercices';
    protected $primaryKey       = 'id';
    protected $returnType       = Exercice::class;
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'description', 'rest_time', 'reps', 'nber_series', 'time_series', 'id_cat', 'id_muscle'
    ];
}
