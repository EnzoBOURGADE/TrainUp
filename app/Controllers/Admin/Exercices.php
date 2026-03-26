<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ExerciceModel;
use App\Models\DifficultyModel;
use App\Models\MusclesModel;

class Exercices extends BaseController
{
    protected $model;
    protected $catModel;
    protected $muscleModel;
    protected $difModel;

    public function __construct()
    {
        $this->model = new ExerciceModel();
        $this->catModel = new CategoryModel();
        $this->muscleModel = new MusclesModel();
        $this->difModel = new DifficultyModel();
    }

    public function index()
    {
        return $this->view('/admin/exercices/index');
    }

    public function save()
    {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            if (isset($data['id'])) {
                $this->success('Exercice bien modifié');
            } else {
                $this->success('Exercice bien ajouté');
            }
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/exercices/');
    }

    public function createOrEdit($id = "new")
    {
        helper('form');
        $categories = $this->catModel->findAll();
        $muscles = $this->muscleModel->findAll();
        $difficulties = $this->difModel->findAll();
        if ($id == "new") {
            return $this->view('/admin/exercices/form', [
                'categories' => $categories,
                'muscles' => $muscles,
                'difficulties' => $difficulties,
            ]);
        }
        $exercice = $this->model->find($id);
        if (!$exercice) {
            $this->error('Exercice introuvable');
            return $this->redirect('admin/exercices');
        }
        return $this->view('/admin/exercices/form', [
            'exercice' => $exercice,
            'categories' => $categories,
            'muscles' => $muscles,
            'difficulties' => $difficulties,
            'selectedDifficultyId' => $exercice['difficulty'] ?? null,
            'selectedCategoryId' => $exercice['id_cat'] ?? null,
            'selectedMuscleId' => $exercice['id_muscle'] ?? null,
        ]);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Exercice supprimé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }

    public function info(int $id) {
        if (!$this->model->find($id)) {
            return $this->response->setJSON(['error' => 'Exercice non trouvé']);
        }
        return $this->response->setJSON($this->model);
    }

    public function search()
    {
        $request = $this->request;

        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Requête non autorisée']);
        }
        $search = $request->getGet('search') ?? '';
        $page = (int)($request->getGet('page') ?? 1);
        $limit = 20;
        $result = $this->model->quickSearchForSelect2($search, $page, $limit);
        return $this->response->setJSON($result);
    }
}
