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
        $total_pembelian = $harga_beli * $jumlah_mainan;
        $hasil = $this->db->query("INSERT INTO pembelian SET tgl_pembelian = ?, nama_vendor=?, nama_mainan=?, jumlah_mainan=?, harga_beli=?, total_pembelian=? ", array($tgl, $nama_vendor, $nama_mainan, $jumlah_mainan, $harga_beli, $total_pembelian));

        return $hasil;
    }

    public function InsertJurnal2($tot)
    {
        /* BEGIN
          INSERT INTO jurnal2 (id,kode_akun,tgl_jurnal, waktu, posisi_d_c, nominal,transaksi) VALUES ('411', NEW.Tanggal, NEW.Waktu, 'c', NEW.Harga, 'Penjualan'),('111',NEW.Tanggal, NEW.Waktu, 'd', NEW.Harga, 'Penjualan');
END*/
    date_default_timezone_set("Asia/Jakarta");
        $tgl =  date("Y/m/d");
        $time = date("h:i:sa");
       // $tot = $tp;
        return $this->db->query("INSERT INTO jurnal2 (`id`, `kode_akun`, `tgl_jurnal`, `waktu`, `posisi_d_c`, `nominal`, `transaksi`) values (NULL,'401', '$tgl', '$time','d', '$tot','Pembelian'),(NULL,'111', '$tgl', '$time','c', '$tot','Pembelian');");
    }

    public function insertData2()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl =  date("Y/m/d");
        $namaVendor = $_POST['nama_vendor'];
        $nama =  $_POST['nama_mainan'];
        $harga = $_POST['harga_beli'];
        $subtot = $_POST['total'];
        return $this->db->query("INSERT INTO dummy2 SET tgl_pemesanan = ?, nama_vendor = ?, nama_mainan = ?, jumlah_mainan = ?, harga_beli=?, total_pembelian=? ", array($tgl, $namaVendor, $nama, $harga, $subtot));
    }

    public function DeleteDummy2()
    {
        return $this->db->query("DELETE FROM `dummy2`");
    }

    public function GETDummy2()
    {
        return $this->db->query("SELECT * FROM `dummy2`")->getresult();
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