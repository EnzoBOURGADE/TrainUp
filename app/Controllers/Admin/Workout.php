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

    public function createOrEdit($idProgram, $dateWorkout = null)
    {
        helper('form');

        $exercices = $this->exerciceModel->findAll();
        $programs = $this->programModel->find($idProgram);
        if ($dateWorkout === null) {

            return $this->view('/admin/workout/form', [
                'id_program' => $idProgram,
                'exercices' => $exercices,
                'program' => $programs,
            ]);
        }
        $workout = $this->model->findWorkout($idProgram, $dateWorkout);

        if (!$workout) {
            $this->error('workout introuvable');
            return $this->redirect('admin/workout');
        }

        return $this->view('/admin/workout/form', [
            'workout' => $workout,
            'exercices' => $exercices,
            'program' => $programs,
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

    public function delete($idProgram, $dateWorkout)
    {
        if (!$idProgram || !$dateWorkout) {
            return redirect()
                ->to('/admin/program/' . $idProgram)
                ->with('error', 'Paramètres invalides');
        }
        $deleted = $this->model->deleteWorkout($idProgram, $dateWorkout);
        if ($deleted) {
            return redirect()
                ->to('/admin/program/' . $idProgram)
                ->with('success', 'Séance supprimée avec succès');
        }
        return redirect()
            ->to('/admin/program/' . $idProgram)
            ->with('error', 'Aucune séance supprimée');
    }
}
