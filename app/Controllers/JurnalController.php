<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurnalpemModel;
// use App\Models\laporanModel;
use App\Models\PemesananModel;
use \Dompdf\Dompdf;

class JurnalController extends BaseController
{
	protected $PemesananModel;
	// protected $MenuModel;
	protected $jurnalpemModel;
	public function __construct()
	{
		$this->PemesananModel = new PemesananModel();
		$this->JurnalpemModel = new JurnalpemModel();
		$this->dompdf = new Dompdf();
		
	}
	// public function index()
	// {
	// 	echo view('HeaderBootstrap');
	// 	echo view('SidebarBootstrap');
	// 	$jurnal = $this->jurnallModel->getAll();
	// 	$data = [
	// 		'title' => 'Jurnal Umum',
	// 		'jurnal' => $jurnal
	// 	];

	// 	return view('laporan/jurnal', $data);
	// }
	public function index()
	{
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		$jurnal = $this->JurnalpemModel->getAll();
		$data = [
			'title' => 'Jurnal Umum',
			'jurnal' => $jurnal
		];

		return view('laporan/invoice', $data);
	}

	// public function laporan()
	// {
	// 	echo view('HeaderBootstrap');
	// 	echo view('SidebarBootstrap');
	// 	$jurnal = $this->pemesananModel->getAll();
	// 	$data = [
	// 		'title' => 'Jurnal Umum',
	// 		'jurnal' => $jurnal
	// 	];

	// 	return view('laporan/laporan_pemesanan', $data);
	// }
	// public function print_jurnal()
	// {
	// 	$data['jurnal'] = $this->jurnallModel->findAll();

	// 	$dompdf = new DOMPDF();

	// 	$html = view('laporan/jurnal_dompdf', $data);
	// 	$dompdf->loadHtml($html);
	// 	$dompdf->setPaper('A4', 'potrait');
	// 	$dompdf->render();
	// 	// $dompdf->stream();
	// 	$dompdf->stream('jurnal_umum.pdf', array(
	// 		"Attachment" => false
	// 	));
	// }
	public function print_invoice()
	{
		$data['jurnal'] = $this->jurnalpemModel->getAll();

		$dompdf = new DOMPDF();

		$html = view('laporan/invoice_dompdf', $data);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'potrait');
		$dompdf->render();
		// $dompdf->stream();
		$dompdf->stream('invoice.pdf', array(
			"Attachment" => false
		));
	}
	// public function print_laporan()
	// {
	// 	$data['jurnal'] = $this->jurnallModel->getlaporan();

	// 	$dompdf = new DOMPDF();

	// 	$html = view('laporan/laporan_dompdf', $data);
	// 	$dompdf->loadHtml($html);
	// 	$dompdf->setPaper('A4', 'potrait');
	// 	$dompdf->render();
	// 	// $dompdf->stream();
	// 	$dompdf->stream('laporan_pemesanan.pdf', array(
	// 		"Attachment" => false
	// 	));
	// }
}
