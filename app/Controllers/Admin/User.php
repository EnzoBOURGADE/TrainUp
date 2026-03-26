<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserPermissionModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $model;
    protected $permModel;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->permModel = new UserPermissionModel();
    }
    public function index()
    {
        return $this->view('/admin/user/index');
    }


    public function createOrEdit($id = "new")
    {
        helper('form');
        if ($id == "new") {
            $permissions = $this->permModel->findAll();
            return $this->view('/admin/user/form', [
                'permissions' => $permissions
            ]);
        }

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


    public function save()
    {
        $data = $this->request->getPost();

        if (empty($data['id'])) {
            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
        }
        else {
            unset($data['password']);
        }

        if ($this->model->save($data)) {
            if (isset($data['id'])) {
                $this->success('Utilisateur bien modifié');
            } else {
                $this->success('Utilisateur bien ajouté');
            }
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/user/');
    }


    public function switchActive() {
        $id = $this->request->getPost('id_user');
        $user = $this->model->withDeleted()->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Utilisateur introuvable'
            ]);
        }

        if ($user->isActive()) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Utilisateur désactivé',
                'status' => 'inactive'
            ]);
        } else {
            if ($this->model->reactive($id)) {
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
        $search = $request->getGet('search') ?? '';
        $page = (int)($request->getGet('page') ?? 1);
        $limit = 20;
        $result = $this->model->quickSearchForSelect2($search, $page, $limit);
        return $this->response->setJSON($result);
    }


    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
