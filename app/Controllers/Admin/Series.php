<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SeriesModel;

class Series extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SeriesModel();
    }

    public function index()
    {
        $data['series'] = $this->model->findAll();
        return $this->view('/admin/series/index', $data);
    }
}
