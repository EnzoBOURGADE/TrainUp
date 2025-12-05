<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WorkoutModel;

class Workout extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new WorkoutModel();
    }

    public function index()
    {
        $data['workout'] = $this->model->findAll();
        return $this->view('/admin/workout/index', $data);
    }

    public function create() {
        helper('form');
        $workout = Model('WorkoutModel')->findAll();
        $exercices = Model('ExerciceModel')->findAll();
        $program = Model('ProgramModel')->findAll();

        return $this->view('/admin/workout/form',
            [
                'workout' => $workout,
                'exercices' => $exercices,
                'program' => $program
            ]);
    }

    public function save() {
        $data = $this->request->getPost();
        dd($data);
        $pm = Model('WorkoutModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Workout bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Workout bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/workout/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/workout');
    }

    public function edit($id)
    {
        helper('form');
        $workout = $this->model->find($id);
        $exercice = model('ExerciceModel')->findAll();
        $program = model('ProgramModel')->findAll();

        if (!$workout) {
            $this->error('workout introuvable');
            return $this->redirect('admin/workout');
        }

        return $this->view('/admin/workout/form', [
            'workout' => $workout,
            'exercices' => $exercice,
            'program' => $program,
            'selectedExerciceId' => $workout['id_exercices'] ?? null,
            'selectedProgramId' => $workout['id_program'] ?? null,
        ]);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/workout');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Workout supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
