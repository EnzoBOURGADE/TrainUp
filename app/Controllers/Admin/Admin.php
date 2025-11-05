<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryProgramModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryProgramModel();
    }
    public function dashboard() {
        return $this->view('admin/dashboard');
    }
}
