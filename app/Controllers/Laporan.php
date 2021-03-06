<?php

namespace App\Controllers;

//load model database yang akan digunakan yaitu Laporan

use App\Models\AkunModel;
use App\Models\DataAkunModel;
use App\Models\JurnalModel;
use Dompdf\Dompdf;

class Laporan extends BaseController
{
	public function __construct()
	{
		$this->JurnalModel = new JurnalModel();
		$this->dompdf = new Dompdf();
	}

	public function invoice()
	{
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		$jurnal = $this->jurnalmodel->getAll();
		$data = [
			'title' => 'Jurnal Umum',
			'jurnal' => $jurnal
		];

		return view('laporan/invoice', $data);
	}
	public function laporan_pemesanan()
	{
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		$jurnal = $this->jurnalmodel->getAll();
		$data = [
			'title' => 'Jurnal Umum',
			'jurnal' => $jurnal
		];

		return view('laporan/laporan_pemesanan', $data);
	}
	//edit
	public function jurnal()
	{
		$year = date('Y');
		$month = date('m');
		$data['jurnal'] = $this->JurnalModel->GetJurnal2($year, $month);
		$data['ketTahun'] = $this->JurnalModel->GetYearJurnal();
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		echo view('laporan/jurnal', $data);
	} //edit

	public function jurnal2()
	{
		$year = $_POST['year'];
		$month = $_POST['month'];
		$data['jurnal'] = $this->JurnalModel->GetJurnal($year, $month);
		$data['ketTahun'] = $this->JurnalModel->GetYearJurnal();
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		echo view('laporan/jurnal', $data);
	}

	public function labarugi()
	{
		$data['jurnal'] = $this->JurnalModel->getAll();

		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		echo view('laporan/laba_rugi', $data);
	}

	public function bukubesar()
	{
		$year = date('Y');
		$month = date('m');
		$data['year'] = $this->JurnalModel->GetYearJurnal2();
		$data['BigBook'] = $this->JurnalModel->GetBukuBesar2($year, $month, '111');
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		echo view('laporan/buku_besar2', $data);
	}

	public function bukubesar2()
	{
		$year = $_POST['tahun'];
		$month = $_POST['bulan'];
		$akun = $_POST['akun'];
		$data['year'] = $this->JurnalModel->GetYearJurnal2();
		$data['BigBook'] = $this->JurnalModel->GetBukuBesar2($year, $month, $akun);
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');
		echo view('laporan/buku_besar2', $data);
	}


	public function print_jurnal()
	{
		$data['jurnal'] = $this->JurnalModel->getAll();

		$dompdf = new Dompdf();

		$html = view('laporan/jurnal_dompdf', $data);
		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4', 'potrait');
		$dompdf->render();
		$dompdf->stream();
	}


	public function print_buku_besar()
	{
		$data['jurnal'] = $this->JurnalModel->getAll();

		$dompdf = new Dompdf();

		$html = view('laporan/buku_besar_dompdf', $data);
		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4', 'potrait');
		$dompdf->render();
		$dompdf->stream();
	}


	public function print_laba_rugi()
	{
		$data['jurnal'] = $this->JurnalModel->getAll();

		$dompdf = new Dompdf();

		$html = view('laporan/laba_rugi_dompdf', $data);
		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4', 'potrait');
		$dompdf->render();
		$dompdf->stream();
	}
}
