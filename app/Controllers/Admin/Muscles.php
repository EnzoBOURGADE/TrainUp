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
        $data['muscles'] = $this->model->findAll();
        return $this->view('/admin/muscles/index', $data);
    }

    public function create() {
        helper('form');
        $muscles = Model('MusclesModel')->findAll();

        return $this->view('/admin/muscles/form',
            [
                'muscles' => $muscles
            ]);
    }

    public function save() {
        $data = $this->request->getPost();
        $m = Model('MusclesModel');
        if ($m->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Muscle bien modifié');
            } else {
                $id = $m->getInsertID();
                $this->success('Muscle bien ajouté');
            }
        } else {
            $id = '';
            foreach($m->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/muscles/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/muscles');
    }

    public function edit($id)
    {
        helper('form');
        $muscles = $this->model->find($id);

        if (!$muscles) {
            $this->error('Muscle introuvable');
            return $this->redirect('admin/muscles');
        }

        return $this->view('/admin/muscles/form', [
            'muscles' => $muscles,
        ]);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/muscles');
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
