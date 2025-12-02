<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use CodeIgniter\HTTP\ResponseInterface;

class Program extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProgramModel();
    }

    public function index()
    {
        return $this->view('/admin/program/index');
    }

    public function create() {
        helper('form');
        $program = Model('ProgramModel');
        $category = Model('CategoryModel')->findAll();
        $users = Model('UserModel')->findAll();

        return $this->view('/admin/program/form',
            [
                'categories' => $category,
                'users' => $users
            ]);
    }


    public function edit($id)
    {
        helper('form');
        $program = $this->model->find($id);
        $user = model('UserModel')->findAll();
        $categories = model('CategoryModel')->findAll();

        if (!$program) {
            $this->error('Programme introuvable');
            return $this->redirect('admin/program');
        }

        return $this->view('/admin/program/form', [
            'program' => $program,
            'users' => $user,
            'categories' => $categories,
            'selectedUserId' => $program['id_user'] ?? null,
            'selectedCategoryId' => $program['id_cat'] ?? null,
        ]);
    }

    public function save() {
        $data = $this->request->getPost();
        $pm = Model('ProgramModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Programme bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Programme bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/program');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Programme supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}