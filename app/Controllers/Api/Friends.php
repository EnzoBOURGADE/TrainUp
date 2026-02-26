<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Friends extends ResourceController
{
    protected $modelName = 'App\Models\FriendsModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $friends = $this->model->findAll();
            return $this->respond($friends);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $friend = $this->model->find($id);
            if (!$friend) {
                return $this->failNotFound("Amitiée introuvable");
            }
            return $this->respond(['friend' => $friend]);
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
            return $this->respondCreated(['id' => $id, 'message' => 'Amitiée créée']);
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
            return $this->respond(['message' => "Amitiée mise à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Amitiée introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Amitiée supprimée"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}