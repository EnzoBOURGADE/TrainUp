<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserPermissionModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserPermission extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new UserPermissionModel();
    }


    public function index()
    {
        return $this->view('admin/user-permission');
    }

    public function insert()
    {
        $data = $this->request->getPost();
        if ($this->model->insert($data)) {
            $this->success('Permission utilisateur bien créée');
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/user-permission');
    }

    public function update() {
        $data = $this->request->getPost();
        $id = $data['id'];
        unset($data['id']);
        if ($this->model->update($id, $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "La permission à été modifiée avec succés !",
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $this->model->errors(),
            ]);
        }
    }

    public function delete() {
        $id = $this->request->getPost('id');
        if ($this->model->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "La permission à été supprimée avec succés !",
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $this->model->errors(),
            ]);
        }
    }
}
