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
        return $this->view('/admin/friends-request/index');
    }

    public function create() {
        helper('form');
        $users = Model('UserModel')->findAll();

        return $this->view('/admin/friends-request/form',
            [
                'users' => $users
            ]);
    }

    public function save() {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            if (isset($data['id'])) {
                $this->success('Demande amitié bien modifié');
            } else {
                $this->success('Demande amitié bien ajouté');
            }
        } else {
            $id = '';
            foreach($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/friends-request/');
    }
}
