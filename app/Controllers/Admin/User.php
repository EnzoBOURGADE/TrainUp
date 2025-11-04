<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
        return $this->view('/admin/user/index');
    }

    public function edit($id_user) {
        $um = Model('UserModel');
        $user = $um->find($id_user);
        if (!$user) {
            $this->error('Utilisateur inexistant');
            return $this->redirect('/admin/user');
        }
        helper('form');
        $permissions = Model('UserPermissionModel')->findAll();
        return $this->view('/admin/user/form', ['user' => $user, 'permissions' => $permissions]);
    }

    public function create() {
        helper('form');
        $permissions = Model('UserPermissionModel')->findAll();

        return $this->view('/admin/user/form', ['permissions' => $permissions]);
    }

    public function update()
    {
        $userModel = model('UserModel');
        $data = $this->request->getPost();
        $id = $this->request->getPost('id');
        $user = $userModel->find($id);
        if (!$user) {
            $this->error('Utilisateur inexistant');
            return $this->redirect('/admin/user');
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }
        $user->fill($data);
        if ($userModel->save($user)) {
            $this->success('Utilisateur mis à jour avec succès.');
            return $this->redirect('/admin/user/' . $user->id);
        } else {
            $this->error('Erreur');
            return $this->redirect('/admin/user/' . $user->id);
        }
    }

    public function insert() {
        $userModel = model('UserModel');
        $data = $this->request->getPost();

        if (empty($data['password'])) {
            $this->error('Le mot de passe est obligatoire.');
            return $this->redirect('/admin/user/new');
        }

        $user = new \App\Entities\User();
        $user->fill($data);

        if ($userModel->save($user)) {
            $this->success('Utilisateur créé avec succès.');
            return $this->redirect('/admin/user/');
        } else {
            $this->error('Erreur lors de la création.');
            return $this->redirect('/admin/user/new');
        }
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
