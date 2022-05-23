<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghuniModel extends Model
{
    protected $table = 'penghuni';

    //untuk mendapatkan data seluruh tabel penghuni
    public function getAll()
    {
        return $this->findAll();
    }

    //untuk memasukkan data penghuni
    public function insertData()
    {
        $ktp = $_POST['ktp'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        
        $hasil = $this->db->query("INSERT INTO penghuni 
                                    SET ktp = ?, nama=?, email=?, telepon=? ", array($ktp, $nama, $email, $telepon));
        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel penghuni terurut berdasarkan nama
    public function getAllOrderByName()
    {
        $sql = "SELECT * FROM penghuni 
                WHERE id NOT IN (SELECT id_penghuni FROM pemesanan WHERE status_kamar = 'Isi')
                ORDER BY nama";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();
    }

    //untuk mendapatkan data penghuni sesuai dengan ID untuk diedit
    public function editData($id)
    {
        $dbResult = $this->db->query("SELECT * FROM penghuni WHERE id = ?", array($id));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data penghuni sesuai dengan ID untuk diedit
    public function updateData()
    {
        $id = $_POST['id'];
        $ktp = $_POST['ktp'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $hasil = $this->db->query("UPDATE penghuni 
                                SET ktp = ?, nama=?, email=?, telepon=? 
                                WHERE id =? ", array($ktp, $nama, $email, $telepon, $id));
        return $hasil;
    }

    //untuk menghapus data penghuni
    public function deleteData($id)
    {
        $hasil = $this->db->query("DELETE FROM penghuni WHERE id =? ", array($id));
        return $hasil;
    }
}