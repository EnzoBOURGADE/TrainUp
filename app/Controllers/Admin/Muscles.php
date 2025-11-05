<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MusclesModel;

class Muscles extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MusclesModel();
    }

    public function index()
    {
        $data['muscles'] = $this->model->findAll();
        return $this->view('/admin/muscles/index', $data);
    }
}
