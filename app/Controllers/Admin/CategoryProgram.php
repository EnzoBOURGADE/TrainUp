<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryProgramModel;

class CategoryProgram extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryProgramModel();
    }
    public function index()
    {
        $data['categories_prgm'] = $this->model->findAll();
        return $this->view('/admin/category_program/index', $data);
    }
}
