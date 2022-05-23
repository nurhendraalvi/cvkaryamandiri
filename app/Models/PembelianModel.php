<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';

    //untuk memasukkan data customer
    public function insertData()
    {
        //tambahkan pengecekan login
        if (isset($_SESSION['nama'])) {
            return redirect()->to(base_url('home'));
        }

        $tgl = date('Y-m-d');
        $nama_vendor = $_POST['nama_vendor'];
        $nama_mainan = $_POST['nama_mainan'];
        $jumlah_mainan = $_POST['jumlah_mainan'];
        $harga_beli = $_POST['harga_beli'];
        $total_pembelian = $_POST['total_pembelian'];
        $hasil = $this->db->query("INSERT INTO pembelian SET tgl_pembelian = ?, nama_vendor=?, nama_mainan=?, jumlah_mainan=?, harga_beli=?, total_pembelian=? ", array($tgl, $nama_vendor, $nama_mainan, $jumlah_mainan, $harga_beli, $total_pembelian));

        return $hasil;
    }
    public function UbahDataMainan($data,$id)
    {
        return $this->db->query("UPDATE `mainan` SET `stok_mainan` = '$data' WHERE `mainan`.`id_mainan` = $id;");
    }
    //untuk mendapatkan data seluruh tabel customer
    public function getAll()
    {
        return $this->findAll();
    }

    public function lihatpembelian()
     {
        $dbResult = $this->db->query("SELECT * FROM pembelian");
        return $dbResult->getResult();
     }

    public function ToyGetData()
    {
        $dbResult = $this->db->query("SELECT * FROM mainan");
        return $dbResult->getResult();
    }

    public function ToyGetDataby($vendor)
    {
        return $this->db->query("SELECT * FROM mainan Where id_mainan = '$vendor'")->getResult();
    }
    // public function pembayaran($id)
    // {
    //     $bayar = $_POST['bayar'] + $_POST['biaya_masuk'];
    //     $hasil = $this->db->query("UPDATE pemesanan SET total_bayar = $bayar WHERE id = $id");
    //     return $hasil;
    // }

    // public function lihatpembayaran()
    //  {
    //     $dbResult = $this->db->query("SELECT * FROM pemesanan");
    //     return $dbResult->getResult();
    //  }
}