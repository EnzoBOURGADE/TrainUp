<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryProgramModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryProgram extends BaseController
{
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function __construct()
    {
        $this->model = new CategoryProgramModel();
    }

    /**
     * @return string
     */
    public function index()
    {
        return $this->view('/admin/category-program/index');
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
                $this->success('Catégorie bien modifiée');
            } else {
                $this->success('Catégorie bien ajoutée');
            }
        } else {
            foreach ($this->model->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('admin/category-program/');
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
            return $this->view('/admin/category-program/form');
        }
        $cat_prgrm = $this->model->find($id);
        if (!$cat_prgrm) {
            $this->error('Catégorie introuvable');
            return $this->redirect('admin/category-program');
        }
        return $this->view('/admin/category-program/form', [
            'cat_prgrm' => $cat_prgrm,
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
