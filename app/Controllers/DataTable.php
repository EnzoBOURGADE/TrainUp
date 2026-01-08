<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class DataTable extends BaseController
{
    public function searchdatatable()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'Only AJAX requests allowed']);
        }

        $model_name = $this->request->getPost('model');

        if (empty($model_name) || !preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $model_name)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'Invalid model name']);
        }

        try {
            $model = model($model_name);

            if (!method_exists($model, 'getPaginated')) {
                return $this->response->setStatusCode(400)
                    ->setJSON(['error' => 'Model does not support DataTable']);
            }

            $draw = (int) $this->request->getPost('draw');
            $start = (int) $this->request->getPost('start');
            $length = (int) $this->request->getPost('length');
            $searchValue = $this->request->getPost('search')['value'] ?? '';

            $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
            $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
            $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';

            // 👈 Filtre program_id
            $filters = [];
            $programId = $this->request->getPost('program_id');
            if ($programId) {
                $filters['workout.id_program'] = (int)$programId;
            }

            $data = $model->getPaginated(
                $start,
                $length,
                $searchValue,
                $orderColumnName,
                $orderDirection,
                $filters
            );

            $totalRecords = $model->getTotal($filters);
            $filteredRecords = $model->getFiltered($searchValue, $filters);

            return $this->response->setJSON([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            log_message('error', 'DataTable Error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)
                ->setJSON(['error' => 'Internal server error']);
        }
    }
}