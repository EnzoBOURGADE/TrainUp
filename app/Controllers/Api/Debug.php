<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Debug extends ResourceController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $tokens = $db->table('api_tokens')->get()->getResultArray();
        return $this->respond([
            'tokens_count' => count($tokens),
            'tokens' => $tokens
        ]);
    }
}
