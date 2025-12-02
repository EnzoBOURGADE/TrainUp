<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }
    public function index()
    {
        return $this->view('/admin/user/index');
    }

    public function create() {
    helper('form');
    $users = Model('UserModel')->findAll();
    $permissions = Model('UserPermissionModel')->findAll();

    return $this->view('/admin/user/form',
        [
            'users' => $users,
            'permissions' => $permissions,
        ]);
}

    public function save() {
        $data = $this->request->getPost();
        $pm = Model('UserModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Utilisateur bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Utilisateur bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/user/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        helper('form');
        $users = $this->model->find($id);
        $permissions = model('UserPermissionModel')->findAll();
        if (!$users) {
            $this->error('Utilisateur introuvable');
            return $this->redirect('admin/user');
        }

        return $this->view('/admin/user/form', [
            'users' => $users,
            'permissions' => $permissions,
            'selectedPermissionId' => $users -> id_permission ?? null,
        ]);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/user');
    }

    public function switchActive() {
        $id = $this->request->getPost('id_user');
        $userModel = model('UserModel');
        $user = $userModel->withDeleted()->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Utilisateur introuvable'
            ]);
        }

        if ($user->isActive()) {
            $userModel->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Utilisateur désactivé',
                'status' => 'inactive'
            ]);
        } else {
            if ($userModel->reactive($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Utilisateur activé',
                    'status' => 'active'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Erreur lors de l\'activation'
                ]);
            }
        }
    }

    public function search()
    {
        $request = $this->request;

        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Requête non autorisée']);
        }
        $um = Model('UserModel');
        $search = $request->getGet('search') ?? '';
        $page = (int)($request->getGet('page') ?? 1);
        $limit = 20;
        $result = $um->quickSearchForSelect2($search, $page, $limit);
        return $this->response->setJSON($result);
    }
}
