<?php

namespace App\Models;

use CodeIgniter\Model;

class Modul12Model extends Model
{
    protected $table = 'umkm_puriutami.penjualan';

    public function getAll(){
        // SELECT * FROM toko_buah.iklan ORDER BY tv ASC
        return $this->db->table('umkm_puriutami.penjualan')->orderBy('shoppee', 'ASC')->get()->getResult('array');
    }
}