<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class FriendsRequest extends ResourceController
{
    protected $modelName = 'App\Models\FriendsRequestModel';
    protected $format    = 'json';


    public function index()
    {
        try {
            $frindsRequest = $this->model->findAll();
            return $this->respond($frindsRequest);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function show($id = null)
    {
        try {
            $frindRequest = $this->model->find($id);
            if (!$frindRequest) {
                return $this->failNotFound("Demande d'amitié introuvable");
            }
            return $this->respond(['friendsRequest' => $frindRequest]);
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
            return $this->respondCreated(['id' => $id, 'message' => "Demande d'amitié créée"]);
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
            return $this->respond(['message' => "Demande d'amitié mise à jour"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound("Demande d'amitié introuvable");
            }
            $this->model->delete($id);
            return $this->respondDeleted(['message' => "Demande d'amitié supprimée"]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}