<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Serie extends ResourceController
{
    protected $modelName = 'App\Models\SeriesModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $series = $this->model->findAll();
            return $this->respond($series);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $serie = $this->model->find($id);
            if (!$serie) {
                return $this->failNotFound("Série introuvable");
            }
            return $this->respond(['serie' => $serie]);
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
            return $this->respondCreated(['id' => $id, 'message' => 'Série créée']);
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
            return $this->respond(['message' => "Série mise à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Série introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Série supprimée"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}