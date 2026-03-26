<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DifficultyModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Difficulty extends BaseController
{
    protected $model;
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function __construct()
    {
        $this->model = new DifficultyModel();
    }

    /**
     * @return string
     */
    public function index()
    {
        return $this->view('/admin/difficulty/index');
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException
     */
    public function save()
    {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            if (isset($data['id'])) {
                $this->success('Difficulté bien modifié');
            } else {
                $this->success('Difficulté bien ajouté');
            }
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/difficulty/');
    }


    /**
     * Controller d'accès a page de création ou d'édition
     * @param $id
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function createOrEdit($id = "new") {
        helper('form');
        if($id == "new"){
            return $this->view('/admin/difficulty/form');
        }
        $difficulty = $this->model->find($id);
        if (!$difficulty) {
            $this->error('Difficulté introuvable');
            return $this->redirect('admin/difficulty');
        }
        return $this->view('/admin/difficulty/form', [
            'difficulty' => $difficulty,
        ]);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Difficultée supprimée avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
