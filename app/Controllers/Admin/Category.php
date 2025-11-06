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
        $data['categories'] = $this->model->findAll();
        return $this->view('/admin/category/index', $data);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $cm = Model('CategoryModel');

        if ($cm->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Catégorie supprimée avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ]);
        }
    }
}
