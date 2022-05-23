<?php
namespace App\Controllers;

use App\Models\GrafikModel;
use App\Models\KosanModel;

class Grafik extends BaseController
{
    public function __construct()
    {
		session_start();
        $this->GrafikModel = new GrafikModel();
        //$this->kosanmodel = new KosanModel();
    }

    //untuk grafik line
	public function index()
	{
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        //pastikan chart.js sudah dikopikan ke public/js 
        //tambahkan di header pengaksesan ke jquery dan chart.js
		$data['hasil'] = $this->GrafikModel->getDataLine();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
		//echo view('Grafik/line', $data);
        echo view('Grafik/linetemplate', $data);
	}

    //untuk grafik trend pemesanan
    public function tren_pemesanan(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        $data['hasil'] = $this->GrafikModel->getTrenPemesanan();
        //$data['tahun'] = $this->GrafikModel->getTahunPemesananPembayaran();
        //echo view('Grafik/pemesanan_batang', $data);
        echo view('Grafik/pemesanan_batang', $data);
    }

    // untuk grafik pie
    public function okupansi_kamar(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        $data['koskosan'] = $this->kosanmodel->getAll();
        $data['hasil'] = $this->GrafikModel->getOkupansiKamar();
        echo view('Grafik/piechart_kamar', $data);
    }

    // tes grafik batang
    public function grafikbatang(){
		$data['hasil'] = $this->GrafikModel->getDataGrafikBatang();
		return view('Grafik/batang', $data);
	}

    // contoh grafik pie
    public function grafikpie(){
		$data['hasil'] = $this->GrafikModel->getDataGrafikPie();
		return view('Grafik/pie', $data);
	}
    
}