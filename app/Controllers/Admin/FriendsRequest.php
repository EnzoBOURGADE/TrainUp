<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FriendsRequestModel;

class FriendsRequest extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new FriendsRequestModel();
    }
    public function index()
    {
        $data['friends_request'] = $this->model->findAll();
        return $this->view('/admin/friends-request/index', $data);
    }
}
