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

    public function index()
    {
        $data['difficulties'] = $this->model->findAll();
        return $this->view('/admin/difficulty/index', $data);
    }

    public function create()
    {
        helper('form');
        $difficulty = $this->model->findAll();

        return $this->view('/admin/difficulty/form',
            [
                'difficulties' => $difficulty
            ]);
    }

    public function save()
    {
        $data = $this->request->getPost();
        print_r($data);
        die();
        $d = $this->model;
        if ($d->save($data)) {
            if (isset($data['id'])) {
                $this->success('Difficulté bien modifié');
            } else {
                $this->success('Difficulté bien ajouté');
            }
        } else {
            foreach ($d->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/difficulty/');
    }

    public function store()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/difficulty');
    }

    /*public function edit($id)
    {
        helper('form');
        $difficulty = $this->model->find($id);

        if (!$difficulty) {
            $this->error('Difficulté introuvable');
            return $this->redirect('admin/difficulty');
        }

        return $this->view('/admin/difficulty/form', [
            'difficulty' => $difficulty,
        ]);
    }*/

    /*public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/difficulty');
    }*/
}
