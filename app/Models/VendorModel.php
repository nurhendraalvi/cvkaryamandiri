<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table = 'vendor';

    public function insertData()
    {
        $nama_vendor = $_POST['nama_vendor'];
        $alamat_vendor = $_POST['alamat_vendor'];
        $no_telp_vendor = $_POST['no_telp_vendor'];
        $hasil = $this->db->query("INSERT INTO vendor 
                                    SET nama_vendor = ?, alamat_vendor=?, no_telp_vendor=?", array($nama_vendor, $alamat_vendor, $no_telp_vendor));
        return $hasil;
    }
    
    public function insertData2()
    {
        $nama_vendor = $_POST['nama_vendor'];
        $hasil = $this->db->query("INSERT INTO vendor 
                                    SET nama_vendor = ?", array($nama_vendor));
        return $hasil;
    }

    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM vendor ORDER BY nama_vendor");
        return $dbResult->getResult();
    }

    //untuk mendapatkan data vendor sesuai dengan ID untuk diedit
    public function editData($id_vendor){
        $dbResult = $this->db->query("SELECT * FROM vendor WHERE id_vendor = ?", array($id_vendor));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data coa sesuai dengan ID untuk diedit
    public function updateData(){
        $id_vendor = $_POST['id_vendor'];
        $nama_vendor = $_POST['nama_vendor'];
        $alamat_vendor = $_POST['alamat_vendor'];
        $no_telp_vendor = $_POST['no_telp_vendor'];
        $hasil = $this->db->query("UPDATE vendor 
                                SET nama_vendor = ?, alamat_vendor=?, no_telp_vendor=? 
                                WHERE id_vendor =? ", array($nama_vendor, $alamat_vendor, $no_telp_vendor, $id_vendor));
        return $hasil;
    }

    //untuk menghapus data coa
    public function deleteData($id_vendor){
        $hasil = $this->db->query("DELETE FROM vendor WHERE id_vendor =? ", array($id_vendor));
        return $hasil;
    }

}