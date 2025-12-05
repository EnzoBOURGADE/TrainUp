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

    public function create() {
        helper('form');
        $exercices = Model('ExerciceModel')->findAll();
        $category = Model('CategoryModel')->findAll();
        $muscles = Model('MusclesModel')->findAll();

        return $this->view('/admin/exercices/form',
            [
                'exercices' => $exercices,
                'categories' => $category,
                'muscles' => $muscles
            ]);
    }

    public function save() {
        $data = $this->request->getPost();
        $pm = Model('ExerciceModel');
        if ($pm->save($data)) {
            if (isset($data['id'])) {
                $id = $data['id'];
                $this->success('Exercice bien modifié');
            } else {
                $id = $pm->getInsertID();
                $this->success('Exercice bien ajouté');
            }
        } else {
            $id = '';
            foreach($pm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/exercices/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/exercices');
    }

    public function edit($id)
    {
        helper('form');
        $exercice = $this->model->find($id);
        $categories = model('CategoryModel')->findAll();
        $muscles = model('MusclesModel')->findAll();

        if (!$exercice) {
            $this->error('Exercice introuvable');
            return $this->redirect('admin/exercices');
        }

        return $this->view('/admin/exercices/form', [
            'exercice' => $exercice,
            'categories' => $categories,
            'muscles' => $muscles,
            'selectedCategoryId' => $exercice['id_cat'] ?? null,
            'selectedMuscleId' => $exercice['id_muscle'] ?? null,
        ]);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/exercices');
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

        $exercise = Model('ExerciceModel')->find($id);

        if (!$exercise) {
            return $this->response->setJSON(['error' => 'Exercice non trouvé']);
        }

        return $this->response->setJSON($exercise);
    }

    public function search()
    {
        $request = $this->request;

        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Requête non autorisée']);
        }
        $um = Model('ExerciceModel');
        $search = $request->getGet('search') ?? '';
        $page = (int)($request->getGet('page') ?? 1);
        $limit = 20;
        $result = $um->quickSearchForSelect2($search, $page, $limit);
        return $this->response->setJSON($result);
    }
}
