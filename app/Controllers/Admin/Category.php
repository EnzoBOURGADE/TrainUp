<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Category extends BaseController
{
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    /**
     * @return string
     */
    public function index()
    {
        return $this->view('/admin/category/index');
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException
     */
    public function save()
    {
        $data = $this->request->getPost();
        $d = $this->model;
        if ($d->save($data)) {
            if (isset($data['id'])) {
                $this->success('Catégorie bien modifiée');
            } else {
                $this->success('Catégorie bien ajoutée');
            }
        } else {
            foreach ($d->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/category/');
    }


    /**
     * Controller d'accès à la page de création ou d'édition
     * @param $id
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function createOrEdit($id = "new")
    {
        helper('form');
        if ($id == "new") {
            return $this->view('/admin/category/form');
        }

        $category = $this->model->find($id);

        if (!$category) {
            $this->error('Catégorie introuvable');
            return $this->redirect('admin/category');
        }

        return $this->view('/admin/category/form', [
            'category' => $category,
        ]);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $this->model->delete($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Catégorie supprimée avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID manquant'
            ]);
        }
    }
}
