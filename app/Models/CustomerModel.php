<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';

    public function insertData()
    {
        $nama_customer = $_POST['nama_customer'];
        $alamat_customer = $_POST['alamat_customer'];
        $telepon_customer = $_POST['telepon_customer'];
        $hasil = $this->db->query("INSERT INTO customer 
                                    SET nama_customer = ?, alamat_customer=?, telepon_customer=?", array($nama_customer, $alamat_customer, $telepon_customer));
        return $hasil;
    }
    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM customer ORDER BY nama_customer");
        return $dbResult->getResult();
    }

    //untuk mendapatkan data customer sesuai dengan ID untuk diedit
    public function editData($id_customer){
        $dbResult = $this->db->query("SELECT * FROM customer WHERE id_customer = ?", array($id_customer));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data coa sesuai dengan ID untuk diedit
    public function updateData(){
        $id_customer = $_POST['id_customer'];
        $nama_customer = $_POST['nama_customer'];
        $alamat_customer = $_POST['alamat_customer'];
        $telepon_customer = $_POST['telepon_customer'];
        $hasil = $this->db->query("UPDATE customer 
                                SET nama_customer = ?, alamat_customer=?, telepon_customer=? 
                                WHERE id_customer =? ", array($nama_customer, $alamat_customer, $telepon_customer, $id_customer));
        return $hasil;
    }

    //untuk menghapus data coa
    public function deleteData($id_customer){
        $hasil = $this->db->query("DELETE FROM customer WHERE id_customer =? ", array($id_customer));
        return $hasil;
    }

}