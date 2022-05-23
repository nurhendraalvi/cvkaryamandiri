<?php

namespace App\Models;

use CodeIgniter\Model;

class MesinlearningModel extends Model
{
    //protected $table = 'akun';

    public function getDataPrediksiPenjualan(){
        $sql = "SELECT OrderDate,ROUND(sum(`TotalRevenue`)) as revenue 
                FROM umkm_puriutami.penjualan 
                GROUP BY OrderDate ORDER BY 1";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
            foreach($results as $data){
                $hasil[] = $data;
            }
            return $hasil;
    }
}