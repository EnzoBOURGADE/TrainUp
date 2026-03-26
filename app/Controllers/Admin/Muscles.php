<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MusclesModel;

class Muscles extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MusclesModel();
    }

    public function index()
    {
        return $this->view('/admin/muscles/index');
    }

    public function createOrEdit($id = "new")
    {
        helper('form');
        if ($id == "new") {
            return $this->view('/admin/muscles/form');
        }

        $muscle = $this->model->find($id);
        if (!$muscle) {
            $this->error('Muscle introuvable');
            return $this->redirect('admin/muscles');
        }
        return $this->view('/admin/muscles/form', [
            'muscles' => $muscle,
        ]);
    }



    public function save()
    {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            if (!empty($data['id'])) {
                $this->success('Muscle bien modifié');
            } else {
                $this->success('Muscle bien ajouté');
            }
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/muscles/');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Muscles supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
