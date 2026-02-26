<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Muscles extends ResourceController
{
    protected $modelName = 'App\Models\MusclesModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $muscles = $this->model->findAll();
            return $this->respond($muscles);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $muscle = $this->model->find($id);
            if (!$muscle) {
                return $this->failNotFound("Muscle introuvable");
            }
            return $this->respond(['muscle' => $muscle]);
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
            return $this->respondCreated(['id' => $id, 'message' => 'Muscle créé']);
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
            return $this->respond(['message' => "Muscle mise à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Muscle introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Muscle supprimé"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}