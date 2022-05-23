<?php
 /**
  *  
  */ 
namespace App\Models;

use CodeIgniter\Model;
 class PenjualanModel extends Model
 {
 	public function GETDataMainan()
 	{
 		return $this->db->query("SELECT * FROM `mainan`")->getresult();
 	}

    public function insertData()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl =  date("Y/m/d");
        $time = date("h:i:sa");
        $nama =  $_POST['nama_mainan'];
        $harga = $_POST['harga_jual'];
        $quantity = $_POST['quantity'];
        return $this->db->query("INSERT INTO dummy SET tanggal = ?, waktu = ?, nama_mainan = ?, harga=?, quantity=? ", array($tgl, $time, $nama, $harga, $quantity));
    }

    public function insertDataTransaksi()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl =  date("Y/m/d");
        $time = date("h:i:sa");
        $tot = $_POST['subtot'];
        return $this->db->query("INSERT INTO t_penjualan SET Tanggal = ?, Waktu=?, Harga=? ", array($tgl, $time, $tot));
    }

    public function UpdateMainan($id)
    {
        $hasil = $_POST['stok_mainan'] - $_POST['quantity'];
        return $this->db->query("UPDATE mainan SET stok_mainan = $hasil WHERE id_mainan = $id");
    }

    public function DeleteDummy()
    {
        return $this->db->query("DELETE FROM `dummy`");
    }

    public function GETDummy()
    {
        return $this->db->query("SELECT * FROM `dummy`")->getresult();
    }

    public function GETYear()
    {
        return $this->db->query("SELECT year(tanggal) as tahun FROM `t_penjualan` group by year(tanggal)")->getResult();
        //return $this->db->query("SELECT monthname(tanggal) as bulan, count(tanggal) as tot_penjualan, sum(harga) as penjualan FROM `t_penjualan` where year(tanggal) = '$year' group by monthname(tanggal)")->getResult();
    }

    public function GETLap($year)
    {
        return $this->db->query("SELECT monthname(tanggal) as bulan, count(tanggal) as tot_penjualan, sum(harga) as penjualan FROM `t_penjualan` where year(tanggal) = '$year' group by monthname(tanggal)")->getResult();
    }

    public function GETLapMonth($month)
    {
        return $this->db->query("SELECT monthname(tanggal) as bulan, tanggal, count(tanggal) as tot_penjualan, sum(harga) as penjualan FROM `t_penjualan` where monthname(tanggal) = '$month' group by tanggal;")->getResult();
    }

    public function GETLapDaily($day)
    {
        return $this->db->query("SELECT dayname(tanggal) as hari, tanggal, waktu, count(tanggal) as tot_penjualan, sum(harga) as penjualan FROM `t_penjualan` where tanggal = '$day' GROUP BY waktu;")->getResult();
    }
   
 }
?>