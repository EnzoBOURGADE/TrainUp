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

    public function create($id_program)
    {
        helper('form');

        $program = model('ProgramModel')->find($id_program);

        if (!$program) {
            $this->error('Programme introuvable');
            return $this->redirect('admin/workout');
        }
        return $this->view('/admin/workout/form', [
            'id_program' => $id_program,
            'program'    => $program
        ]);
    }


    public function save()
    {
        $data = $this->request->getPost();

        $workoutModel = model('WorkoutModel');
        $seriesModel  = model('SeriesModel');

        if (empty($data['exercices'])) {
            return redirect()->back()->with('error', 'Aucun exercice ajouté');
        }

        foreach ($data['exercices'] as $order => $exercice) {
            if (!empty($exercice['series'])) {
                foreach ($exercice['series'] as $serie) {
                    $seriesModel->insert([
                        'id_program'   => $data['id_program'],
                        'id_exercices' => $exercice['id_exercices'],
                        'reps'         => $serie['reps'],
                        'weight'       => $serie['weight'],
                        'date'         => $data['date'],
                    ]);
                }
            }
            $workoutModel->insert([
                'id_program'   => $data['id_program'],
                'id_exercices' => $exercice['id_exercices'],
                'date'         => $data['date'],
                'order'        => $order + 1,
                'rest_time'    => 0,
            ]);
        }

        return redirect()->to('/admin/program/' . $data['id_program'])->with('success', 'Séance enregistrée avec succès');
    }




    /*public function save()
    {
        $data = $this->request->getPost();
        $workoutModel = model('WorkoutModel');

        foreach ($data['exercices'] as $index => $exercice) {

            $workoutModel->insert([
                'id_program'   => $data['id_program'],
                'date'         => $data['date'],
                'id_exercices' => $exercice['id_exercices'],
                'rest_time'    => gmdate('H:i:s', (int)$exercice['rest_time']),
                'order'        => $index + 1,
            ]);
        }

        $this->success('Workout enregistré avec succès');
        return $this->redirect('admin/workout');
    }*/





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
