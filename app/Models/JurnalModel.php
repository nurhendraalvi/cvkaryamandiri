<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table = 'jurnal';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data pegawai
    public function insertData(){
        $tgl  = date('d-m-Y');

        $data = explode("|", $_POST['id_jurnal']);

        $no_reff = $data[0];
        $nama_akun = $data[1];
        $jenis_saldo = $_POST['jenis_saldo'];
        $saldo = $_POST['saldo'];
        $hasil = $this->db->query("INSERT INTO jurnal SET  no_reff=?, nama_akun=?, tgl_transaksi=?, jenis_saldo=?, saldo=? ", array($no_reff, $nama_akun, $tgl, $jenis_saldo, $saldo));
        return $hasil;
    }

    public function getLaporan()
	{

		$builder = $this->db->table('pemesanan');
		$builder->select('pemesanan.id AS id, pemesanan.tgl_pesan AS tanggal, (pemesanan.harga*pemesanan.qty) AS harga , SUM(pemesanan.harga*pemesanan.qty) as total');
	// 	$builder->join('menu', 'menu.nama_menu = pemesanan.nama_menu');
		$builder->groupBy('pemesanan.id');
		$query = $builder->get();
		return $query->getResult();
	}

    public function inputJurnal($no_reff, $nama_akun, $jenis_saldo, $saldo){
        $tgl  = date('d-m-Y');

        $hasil = $this->db->query("INSERT INTO jurnal SET  no_reff=?, nama_akun=?, tgl_transaksi=?, jenis_saldo=?, saldo=? ", array($no_reff, $nama_akun, $tgl, $jenis_saldo, $saldo));
        return $hasil;    
    }

    //untuk mendapatkan data pegawai sesuai dengan ID untuk diedit
    public function editData($id){
        $dbResult = $this->db->query("SELECT * FROM jurnal WHERE id = ?", array($id));
        return $dbResult->getResult();
    }

    public function getNoReff(){
        return $this->db->query("SELECT DISTINCT no_reff FROM jurnal");
    }

    //untuk mendapatkan data pegawai sesuai dengan ID untuk diedit
    public function updateData(){
        $id = $_POST['id'];
        $no_reff = $_POST['no_reff'];
        $jenis_saldo = $_POST['jenis_saldo'];
        $saldo = $_POST['saldo'];
        $hasil = $this->db->query("UPDATE jurnal SET no_reff=?, jenis_saldo=?, saldo=?  WHERE id =? ", array($no_reff, $jenis_saldo, $saldo, $id));
        return $hasil;
    }

    //untuk menghapus data pegawai sesuai ID yang dipilih
    public function deleteData($id){
        $hasil = $this->db->query("DELETE FROM jurnal WHERE id =? ", array($id));
        return $hasil;
    }
}