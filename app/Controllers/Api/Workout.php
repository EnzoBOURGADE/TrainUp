<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Workout extends ResourceController
{
    protected $modelName = 'App\Models\WorkoutModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $workout = $this->model->findAll();
            return $this->respond($workout);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $workout = $this->model->find($id);
            if (!$workout) {
                return $this->failNotFound("Séance introuvable");
            }
            return $this->respond(['workout' => $workout]);
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
            return $this->respondCreated(['id' => $id, 'message' => 'Séance créée']);
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
            return $this->respond(['message' => "Séance mise à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Séance introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Séance supprimée"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}