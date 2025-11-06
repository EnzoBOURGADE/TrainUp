<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FriendsModel;

class Friends extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new FriendsModel();
    }
    public function index()
    {
        $data['friends'] = $this->model->findAll();
        return $this->view('/admin/friends/index', $data);
    }
}
