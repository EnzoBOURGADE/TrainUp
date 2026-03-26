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
        return $this->view('admin/user-permission/index');
    }


    public function createOrEdit($id = "new")
    {
        $perm = $this->model->find($id);
        helper('form');
        if ($id == "new") {
            return $this->view('/admin/user-permission/form', [
                'permissions' => $perm,
            ]);
        }
        if (!$perm) {
            $this->error('Permission introuvable');
            return $this->redirect('admin/user-permission');
        }
        return $this->view('/admin/user-permission/form', [
            'permissions' => $perm,
        ]);
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



    public function save()
    {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            if (!empty($data['id'])) {
                $this->success('Permission bien modifiée');
            } else {
                $this->success('Permission bien ajoutée');
            }
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/user-permission');
    }
}
