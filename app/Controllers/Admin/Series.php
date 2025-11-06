<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SeriesModel;

class Series extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SeriesModel();
    }

    public function create() {
        helper('form');
        $series = Model('SeriesModel')->findAll();
        $program = Model('ProgramModel')->findAll();
        $exercices = Model('ExerciceModel')->findAll();

        return $this->view('/admin/series/form',
            [
                'series' => $series,
                'program' => $program,
                'exercices' => $exercices
            ]);
    }


    public function save() {
        $data = $this->request->getPost();
        $pm = Model('SeriesModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Séries bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Séries bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/series/');
    }


    public function index()
    {
        $data['series'] = $this->model->findAll();
        return $this->view('/admin/series/index', $data);
    }
}
