<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Exercices extends ResourceController
{
    protected $modelName = 'App\Models\ExerciceModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $exercices = $this->model->findAll();
            return $this->respond($exercices);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $exercice = $this->model->find($id);
            if (!$exercice) {
                return $this->failNotFound("Exercice introuvable");
            }
            return $this->respond(['exercice' => $exercice]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function create()
    {
        $data = $this->request->getPost();
        try {
            if (!$this->model->insert($data)) {
                return $this->failValidationErrors($this->model->errors());
            }
            $id = $this->model->getInsertID();
            return $this->respondCreated(['id' => $id, 'message' => 'Exercice créé']);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        try {
            if (!$this->model->update($id, $data)) {
                return $this->failValidationErrors($this->model->errors());
            }
            return $this->respond(['message' => "Exercice mis à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Exercice introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Exercice supprimé"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}