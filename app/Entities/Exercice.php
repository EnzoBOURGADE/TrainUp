<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Exercice extends Entity
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'time_series'];

    public function isActive(): bool
    {
        return $this->deleted_at === null;
    }
}
