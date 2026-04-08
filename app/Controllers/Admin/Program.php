<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CategoryProgramModel;
use App\Models\ProgramModel;
use App\Models\SeriesModel;
use App\Models\UserModel;
use App\Models\WorkoutModel;
use CodeIgniter\HTTP\ResponseInterface;

class Program extends BaseController
{
    protected $model;
    protected $workoutModel;
    protected $userModel;
    protected $catProModel;
    protected $serieModel;

    public function __construct()
    {
        $this->model = new ProgramModel();
        $this->workoutModel = new WorkoutModel();
        $this->userModel = new UserModel();
        $this->catProModel = new CategoryProgramModel();
        $this->serieModel = new SeriesModel();
    }

    public function index()
    {
        return $this->view('/admin/program/index');
    }

    public function createOrEdit($id = "new")
    {
        helper('form');
        $program = $this->model->find($id);
        $user = $this->userModel->findAll();
        $categoriesProgram = $this->catProModel->findAll();
        $workout = $this->workoutModel->FindWorkoutById($id);

        if ($id == "new") {
            return $this->view('/admin/program/form', [
                'users' => $user,
                'categoriesProgram' => $categoriesProgram
            ]);
        }

        if (!$program) {
            $this->error('Programme introuvable');
            return $this->redirect('admin/program');
        }

        return $this->view('/admin/program/form', [
            'program' => $program,
            'users' => $user,
            'workout' => $workout,
            'categoriesProgram' => $categoriesProgram,
            'selectedUserId' => $program['id_user'] ?? null,
            'selectedCategoryProgramId' => $program['id_cat'] ?? null,
        ]);
    }

    public function save()
    {
        $data = $this->request->getPost();

        if ($this->model->save($data)) {
            if (!empty($data['id'])) {
                $this->success('Programme bien modifié');
                return $this->redirect('admin/program/');
            }
            $id = $this->model->getInsertID();
            $this->success('Programme bien ajouté');
            return $this->redirect('admin/program/' . $id);

        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
            return $this->redirect('admin/program');
        }
    }


    public function delete()
    {
        $id = $this->request->getPost('id');
        $date = $this->request->getPost('date');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Programme supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}