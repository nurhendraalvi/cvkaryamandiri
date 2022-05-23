<?php

namespace App\Models;

use CodeIgniter\Model;

class MainanModel extends Model
{
    protected $table = 'mainan';

    public function insertData()
    {
        $nama_vendor = $_POST['nama_vendor'];
        $nama_mainan = $_POST['nama_mainan'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok_mainan = $_POST['stok_mainan'];
        $hasil = $this->db->query("INSERT INTO mainan 
                                    SET nama_vendor = ?,nama_mainan = ?, harga_beli=?, harga_jual=?,stok_mainan = ?", array($nama_vendor, $nama_mainan, $harga_beli, $harga_jual, $stok_mainan));
        return $hasil;
    }
    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM mainan ORDER BY id_mainan");
        return $dbResult->getResult();
    }

    //untuk mendapatkan data mainan sesuai dengan ID untuk diedit
    public function editData($id_mainan){
        $dbResult = $this->db->query("SELECT * FROM mainan WHERE id_mainan = ?", array($id_mainan));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data coa sesuai dengan ID untuk diedit
    public function updateData(){
        $id_mainan = $_POST['id_mainan'];
        $nama_vendor = $_POST['nama_vendor'];
        $nama_mainan = $_POST['nama_mainan'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $hasil = $this->db->query("UPDATE mainan 
                                SET nama_vendor = ?, nama_mainan = ?, harga_beli=?, harga_jual=?, stok_mainan = ? 
                                WHERE id_mainan =? ", array($nama_vendor, $nama_mainan, $harga_beli, $harga_jual, $stok_mainan, $id_mainan));
        return $hasil;
    }

    //untuk menghapus data coa
    public function deleteData($id_mainan){
        $hasil = $this->db->query("DELETE FROM mainan WHERE id_mainan =? ", array($id_mainan));
        return $hasil;
    }
    
    public function UptadeDataToy($where, $data, $table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    

}