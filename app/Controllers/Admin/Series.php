<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExerciceModel;
use App\Models\ProgramModel;
use App\Models\SeriesModel;

class Series extends BaseController
{
    protected $model;
    protected $programModel;
    protected $exerciceModel;

    public function __construct()
    {
        $this->model = new SeriesModel();
        $this->programModel = new ProgramModel();
        $this->exerciceModel = new ExerciceModel();
    }


    public function createOrEdit($id = "new")
    {
        helper('form');
        if ($id == "new") {
            $program = $this->programModel->findAll();
            $exercices = $this->exerciceModel->findAll();

            return $this->view('/admin/series/form',
                [
                    'program' => $program,
                    'exercices' => $exercices
                ]);
        }
    }


    public function save() {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            if (isset($data['id'])) {
                $this->success('Séries bien modifié');
            } else {
                $this->success('Séries bien ajouté');
            }
        } else {
            foreach($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/series/');
    }


    public function index()
    {
        return $this->view('/admin/series/index');
    }
}
