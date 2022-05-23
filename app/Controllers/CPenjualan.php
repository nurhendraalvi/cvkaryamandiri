<?php
/**
 * 
 */
 
namespace App\Controllers;

use App\Models\PenjualanModel;
class CPenjualan extends BaseController
{
	
	function __construct()
	{
		//parent::__construct();
		//$this->load->model('PenjualanModel');
		$this->PenjualanModel = new PenjualanModel();
	}

	public function PenjualanView()
	{
		$data['mainan'] = $this->PenjualanModel->GETDataMainan();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penjualan/ViewPenjualan', $data);
	}

	public function Insertdummy()
	{
		//dummy
		$id = $_POST['id_mainan'];
		$this->PenjualanModel->UpdateMainan($id);
		$this->PenjualanModel->insertData();
		return redirect()->to(base_url('CPenjualan/PenjualanView'));
	}

	public function CheckOutView()
	{
		$data['dummy'] = $this->PenjualanModel->GETDummy();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penjualan/TPenjualan', $data);
	}

	public function InsertTransaksi()
	{
		//dummy
		//$id = $_POST['id_mainan'];
		//$this->PenjualanModel->DeleteDummy();
		$this->PenjualanModel->insertDataTransaksi();
		return redirect()->to(base_url('CPenjualan/PenjualanView'));
	}
}
?>