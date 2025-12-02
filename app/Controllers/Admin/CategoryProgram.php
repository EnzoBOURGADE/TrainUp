<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryProgramModel;

class CategoryProgram extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryProgramModel();
    }
    public function index()
    {
        $data['categories_prgm'] = $this->model->findAll();
        return $this->view('/admin/category-program/index', $data);
    }

    public function create() {
        helper('form');
        $cat_prgrm = Model('CategoryProgramModel')->findAll();

        return $this->view('/admin/category-program/form',
            [
                'cat_prgrm' => $cat_prgrm
            ]);
    }

    public function save() {
        $data = $this->request->getPost();
        $pm = Model('CategoryProgramModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Catégorie de programme bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Catégorie de programme bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/category-program/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/category-program');
    }

    public function edit($id)
    {
        helper('form');
        $cat_prgrm = $this->model->find($id);

        if (!$cat_prgrm) {
            $this->error('Catégorie de programme introuvable');
            return $this->redirect('admin/category-program');
        }

        return $this->view('/admin/category-program/form', [
            'cat_prgrm' => $cat_prgrm,
        ]);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/category-program');
    }


    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Catégorie de programme supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
