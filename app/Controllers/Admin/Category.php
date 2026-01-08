<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function index()
    {
        return $this->view('/admin/category/index');
    }

    public function create() {
        helper('form');
        $category = Model('CategoryModel');

        return $this->view('/admin/category/form',
            [
                'categories' => $category
            ]);
    }


    public function edit($id)
    {
        helper('form');
        $category = $this->model->find($id);

        if (!$category) {
            $this->error('Catégorie introuvable');
            return $this->redirect('admin/category');
        }

        return $this->view('/admin/category/form', [
            'category' => $category,
        ]);
    }

    public function save() {
        $data = $this->request->getPost();
        $ct = Model('CategoryModel');
        if ($ct->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Catégorie bien modifié');
            } else {
                $id = $ct->getInsertID();
                $this->success('Catégorie bien ajouté');
            }
        } else {
            $id = '';
            foreach($ct->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/category');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Catégorie supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
