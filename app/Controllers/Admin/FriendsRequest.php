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

    public function create() {
        helper('form');
        $friendsRequest = Model('FriendsRequestModel')->findAll();
        $users = Model('UserModel')->findAll();

        return $this->view('/admin/friends-request/form',
            [
                'friendsRequest' => $friendsRequest,
                'users' => $users
            ]);
    }

    public function save() {
        $data = $this->request->getPost();
        $pm = Model('FriendsRequestModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Demande amitié bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Demande amitié bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/friends-request/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/friends-request');
    }
}
