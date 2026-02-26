<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Program extends ResourceController
{
    protected $modelName = 'App\Models\ProgramModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $programs = $this->model->findAll();
            return $this->respond($programs);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $program = $this->model->find($id);
            if (!$program) {
                return $this->failNotFound("Programme introuvable");
            }
            return $this->respond(['program' => $program]);
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
            return $this->respondCreated(['id' => $id, 'message' => 'Programme créé']);
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
            return $this->respond(['message' => "Programme mis à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Programme introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Programme supprimé"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}