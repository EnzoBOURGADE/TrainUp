<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExerciceModel;
use App\Models\ProgramModel;
use App\Models\SeriesModel;
use App\Models\WorkoutModel;

class Workout extends BaseController
{
    protected $model;
    protected $seriesModel;
    protected $exerciceModel;
    protected $programModel;

    public function __construct()
    {
        $this->model = new WorkoutModel();
        $this->seriesModel  = new SeriesModel();
        $this->exerciceModel  = new ExerciceModel();
        $this->programModel  = new ProgramModel();
    }

    public function index()
    {
        return $this->view('/admin/workout/index');
    }



    public function createOrEdit($id = "new")
    {
        helper('form');
        if ($id == "new") {
            return $this->view('/admin/muscles/form');
        }

        $workout = $this->model->find($id);
        $exercice = $this->exerciceModel->findAll();
        $program =  $this->programModel->findAll();

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


    public function save()
    {
        $data = $this->request->getPost();

        if (empty($data['exercices'])) {
            return redirect()->back()->with('error', 'Aucun exercice ajouté');
        }

        foreach ($data['exercices'] as $order => $exercice) {
            if (!empty($exercice['series'])) {
                foreach ($exercice['series'] as $serie) {
                    $this->seriesModel->insert([
                        'id_program'   => $data['id_program'],
                        'id_exercices' => $exercice['id_exercices'],
                        'reps'         => $serie['reps'],
                        'weight'       => $serie['weight'],
                        'date'         => $data['date'],
                    ]);
                }
            }
            $this->model->insert([
                'id_program'   => $data['id_program'],
                'id_exercices' => $exercice['id_exercices'],
                'date'         => $data['date'],
                'order'        => $order + 1,
                'rest_time'    => 0,
            ]);
        }

        return redirect()->to('/admin/program/' . $data['id_program'])->with('success', 'Séance enregistrée avec succès');
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
