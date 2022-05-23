<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';

    //untuk memasukkan data customer
    public function insertData()
    {
        //tambahkan pengecekan login
        if (isset($_SESSION['nama'])) {
            return redirect()->to(base_url('home'));
        }

        $tgl = date('Y-m-d');
        $nama_pemesanan = $_POST['nama_pemesanan'];
        $total_pemesanan = $_POST['total_pemesanan'];
        $total_bayar = $_POST['total_bayar'];
        $hasil = $this->db->query("INSERT INTO pemesanan SET tgl_pemesanan = ?, nama_pemesanan=?, total_pemesanan=?, total_bayar=? ", array($tgl, $nama_pemesanan, $total_pemesanan, $total_bayar));

        return $hasil;
    }

    //untuk mendapatkan data seluruh tabel customer
    public function getAll()
    {
        return $this->findAll();
    }

    public function lihatpemesanan()
     {
        $dbResult = $this->db->query("SELECT * FROM pemesanan");
        return $dbResult->getResult();
     }

    public function pembayaran($id)
    {
        $bayar = $_POST['bayar'] + $_POST['biaya_masuk'];
        $hasil = $this->db->query("UPDATE pemesanan SET total_bayar = $bayar WHERE id = $id");
        return $hasil;
    }

    public function lihatpembayaran()
     {
        $dbResult = $this->db->query("SELECT * FROM pemesanan");
        return $dbResult->getResult();
     }
}