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

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/friends');
    }

    public function delete()
    {
        $user1 = $this->request->getPost('id_user_1');
        $user2 = $this->request->getPost('id_user_2');

        if ($user1 && $user2) {
            $builder = $this->model->builder();
            $builder->where("(id_user_1 = {$user1} AND id_user_2 = {$user2}) OR (id_user_1 = {$user2} AND id_user_2 = {$user1})")
                ->delete();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Amitié supprimée avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }

}
