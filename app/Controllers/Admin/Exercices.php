<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExerciceModel;

class Exercices extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ExerciceModel();
    }

    public function index()
    {
        $data['exercices'] = $this->model->findAll();
        return $this->view('/admin/exercices/index', $data);
    }

    public function create()
    {
        return view('exercices/create');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/exercices');
    }

    public function edit($id)
    {
        $data['exercice'] = $this->model->find($id);
        return view('exercices/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/exercices');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/exercices');
    }
}
