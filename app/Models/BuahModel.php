<?php

namespace App\Models;

use CodeIgniter\Model;

class BuahModel extends Model
{
    protected $table = 'buah';

    public function getAll(){
        return $this->findAll();
    }
}