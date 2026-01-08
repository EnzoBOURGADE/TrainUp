<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\WorkoutModel;
use CodeIgniter\HTTP\ResponseInterface;

class Program extends BaseController
{
    protected $model;
    protected $workoutModel;

    public function __construct()
    {
        $this->model = new ProgramModel();
        $this->workoutModel = new WorkoutModel();
    }

    public function index()
    {
        return $this->view('/admin/program/index');
    }

    public function create() {
        helper('form');
        $program = null;
        $categoryProgram = Model('CategoryProgramModel')->findAll();
        $users = Model('UserModel')->findAll();

        return $this->view('/admin/program/form',
            [
                'program' => $program,
                'categoriesProgram' => $categoryProgram,
                'users' => $users
            ]);
    }


    public function edit($id)
    {
        helper('form');
        $program = $this->model->find($id);
        $user = model('UserModel')->findAll();
        $categoriesProgram = model('CategoryProgramModel')->findAll();
        $workout = $this->workoutModel->FindWorkoutById($id);

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
        $pm = model('ProgramModel');

        if ($pm->save($data)) {
            if (!empty($data['id'])) {
                $this->success('Programme bien modifié');
                return $this->redirect('admin/program/' . $data['id']);
            }
            $id = $pm->getInsertID();
            $this->success('Programme bien ajouté');
            return $this->redirect('admin/program/' . $id);

        } else {
            foreach ($pm->errors() as $error) {
                $this->error($error);
            }
            return $this->redirect('admin/program');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

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