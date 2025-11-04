<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WorkoutModel;

class Workout extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new WorkoutModel();
    }

    public function index()
    {
        $data['workout'] = $this->model->findAll();
        return $this->view('/admin/workout/index', $data);
    }
}
