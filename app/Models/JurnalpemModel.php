<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalpemModel extends Model
{
	protected $table      = 'jurnal';
	protected $primaryKey = 'id';
	protected $allowedFields = ['no_reff', 'tgl_transaksi', 'nama_akun', 'jenis_saldo', 'saldo'];

	protected $useAutoIncrement = true;

	public function getAll()
	{

		$builder = $this->db->table('Pemesanan');
		$builder->select('Pemesanan.id AS id, Pemesanan.tgl_pemesanan AS tgl_pemesanan, pemesanan.nama_pemesanan AS nama_pemesanan, 
		pemesanan.total_pemesanan AS total_pemesanan, pemesanan.total_bayar AS total_bayar');
		// $builder->join('menu', 'menu.nama_menu = pemesanan.nama_menu');
		$builder->groupBy('Pemesanan.tgl_pemesanan');
		$query = $builder->get();
		return $query->getResult();
	}

	// public function getLaporan()
	// {

	// 	$builder = $this->db->table('pemesanan');
	// 	$builder->select('pemesanan.id AS id, pemesanan.tgl_pesan AS tanggal, (menu.harga*pemesanan.qty) AS harga , SUM(menu.harga*pemesanan.qty) as total');
	// 	$builder->join('menu', 'menu.nama_menu = pemesanan.nama_menu');
	// 	$builder->groupBy('pemesanan.id');
	// 	$query = $builder->get();
	// 	return $query->getResult();
	// }

}
