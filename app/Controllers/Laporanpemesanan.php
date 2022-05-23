<?php

namespace App\Controllers;
use App\Models\PemesananModel;
use App\Models\PenjualanModel;
use App\Models\GrafikPemesananModel;
//use App\Models\GrafikPenjualanModel;

use Dompdf\Options;

class Laporanpemesanan extends BaseController
{
	public function __construct()
    {
		session_start();
        $this->PemesananModel = new PemesananModel();
        $this->PenjualanModel = new PenjualanModel();
        $this->GrafikPemesananModel = new GrafikPemesananModel();
        //$this->GrafikPenjualanModel = new GrafikPenjualanModel();

        helper('rupiah');
        helper('waktu');
    }

    public function LaporanPenjualan()
    {
        $th = date('Y');
        $data['year'] = $this->PenjualanModel->GETYear();
        $data['data2'] = $this->PenjualanModel->GETLap($th);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('laporan/VLaporanPenjualan', $data);
    }

    public function LaporanPenjualan2()
    {
        $th = $_POST['data'];
        $data['year'] = $this->PenjualanModel->GETYear();
        $data['data2'] = $this->PenjualanModel->GETLap($th);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('laporan/VLaporanPenjualan', $data);
    }

    public function MonthReport($bln)
    {
        //$th = $_POST['data'];
        //$data['bln'] = $bln;
        $data['data2'] = $this->PenjualanModel->GETLapMonth($bln);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('laporan/VMonthReport', $data);
    }

    public function DailyReport($bln)
    {
        //$th = $_POST['data'];
        //$data['bln'] = $bln;
        $data['data2'] = $this->PenjualanModel->GETLapDaily($bln);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('laporan/VDailyReport', $data);
    }

      //data table pembayaran
    public function laporanpemesanan(){
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['pembelian'] = $this->PemesananModel->getAll();
        $data['tahun'] = $this->GrafikPemesananModel->getTahunPemesanan();
        //$data['bulan'] = $this->GrafikPembelianModel->getBulanPemesanan();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporanpemesanan/LaporanPemesanan', $data);
    }
    public function bulanpemesanan($tahun){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        //encode
        echo json_encode($this->GrafikPemesananModel->getBulanPemesanan($tahun));
    }

    //cetak kuitansi
    public function lihatlaporanpemesanan(){
        
        //DB::disableQueryLog();
        helper('rupiah');
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['pembelian'] = $this->GrafikPemesananModel->getLaporanPemesanan($_POST['tahun'], $_POST['bulan'] );
        //$data['kosan'] = $this->kosanmodel->editData($_POST['namakos']);
        $data['tahun'] = $_POST['tahun'];
        $data['bulan'] = $_POST['bulan'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporanpemesanan/LihatLaporanpemesanan', $data);               
    }


    //    //data table pembayaran
    //    public function laporanpenjualan(){
    //     //tambahkan pengecekan login
    //     if(!isset($_SESSION['nama'])){
    //         return redirect()->to(base_url('home')); 
    //     }
    //     $data['penjualan'] = $this->PenjualanModel->getAll();
    //     $data['tahun'] = $this->GrafikPenjualanModel->getTahunPenjualan();
    //     //$data['bulan'] = $this->GrafikPenjualanModel->getBulanPenjualan();
    //     echo view('HeaderBootstrap');
    //     echo view('SidebarBootstrap');
    //     echo view('Laporan/LaporanPenjualan', $data);
    // }
    // public function bulanpenjualan($tahun){
    //     if(!isset($_SESSION['nama'])){
    //         return redirect()->to(base_url('home')); 
    //     }
    //     //encode
    //     echo json_encode($this->GrafikPenjualanModel->getBulanPenjualan($tahun));
    // }
    // //cetak kuitansi
    // public function lihatlaporanpenjualan(){
        
    //     //DB::disableQueryLog();
    //     helper('rupiah');
    //     if(!isset($_SESSION['nama'])){
    //         return redirect()->to(base_url('home')); 
    //     }
    //     $data['penjualan'] = $this->GrafikPenjualanModel->getLaporanPenjualan($_POST['tahun'], $_POST['bulan'] );
    //     //$data['kosan'] = $this->kosanmodel->editData($_POST['namakos']);
    //     $data['tahun'] = $_POST['tahun'];
    //     $data['bulan'] = $_POST['bulan'];
    //     echo view('HeaderBootstrap');
    //     echo view('SidebarBootstrap');
    //     echo view('Laporan/LihatLaporanpenjualan', $data);               
    // }
  
  
    //data table pembayaran
    public function tabelpembayaran(){
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['pembayaran'] = $this->PembayaranModel->getInfoPembayaran();

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/ListPembayaran', $data);
    }

    //cetak kuitansi
    public function kuitansi($id_pembayaran){
        helper('rupiah');
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['kuitansi'] = $this->PembayaranModel->getInfoPembayaranById($id_pembayaran);
        $data['sisa_bayar'] = $this->PembayaranModel->getSisaBayar($id_pembayaran);
        //echo view('Laporan/Cetakkuitansi', $data);
        //echo view('Laporan/Cetakkuitansi2', $data);
        //echo view('Laporan/Cetakkuitansidompdf', $data);

        //tambahan agar gambar tampil
        //https://www.youtube.com/watch?v=bM3y5TY-7_k

        //panggil dom untuk cetak pdf
        //$dompdf = new \Dompdf\Dompdf($options);

        $dompdf = new \Dompdf\Dompdf(); 
        $html = view('Laporan/Cetakkuitansidompdf', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A6', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        
    }

    //cetak kuitansi 2
    public function kuitansi2($id_pembayaran){
        helper('rupiah');
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['kuitansi'] = $this->PembayaranModel->getInfoPembayaranById($id_pembayaran);
        $data['sisa_bayar'] = $this->PembayaranModel->getSisaBayar($id_pembayaran);
        echo view('Laporan/Cetakkuitansi2', $data);
    
    }


    //litys kosan
    public function daftarkosan(){
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['barang'] = $this->barangmodel->getAll();

        $ar = array();
        $i = 0;
        foreach($data['barang'] as $row):
            array_push($ar, array($row['id'],0,0,0)); //inisialisasi array [1],[2],[3] dengan 0
            $i++;
        endforeach;

        for($i=0;$i<count($ar);$i++){
            $ar[$i][1] = $this->barangmodel->getInfoKamar($ar[$i][0], 'all');
            $ar[$i][2] = $this->kosanmodel->getInfoKamar($ar[$i][0], 'Isi');
            $ar[$i][3] = $this->kosanmodel->getInfoKamar($ar[$i][0], 'Kosong');
        }
        //hasil array jumlah data kosan
        $data['infokosan'] = $ar;

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/Daftarkosan', $data);
    }

    //status pembayaran tiap kamar
    public function statusbayarperkamar($id_kos, $namakos){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        helper('rupiah');
        $data['pembayaran'] = $this->PembayaranModel->getInfoPembayaranPerKamar($id_kos);
        $data['namakos'] = $namakos;
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/ListPembayaranPerKosan', $data);
    }
    
    //lihat beban
    public function lihatbeban(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['beban'] = $this->PembebananModel->getListBeban();
        //maka kembalikan ke awal
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembebanan/LihatBeban', $data);
    }

    //jurnal umum
    public function jurnalumum(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['tahun'] = $this->coaModel->getPeriodeTahun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/Jurnal', $data);
    }

    //json encode untuk list bulan
    public function listbulan($tahun){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        //encode
        echo json_encode($this->coaModel->getPeriodeBulan($tahun));
    }

    //proses lihat jurnal umum
    public function lihatjurnalumum(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['jurnal'] = $this->coaModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LihatJurnal', $data);
    }

    //buku besar
    public function bukubesar(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['tahun'] = $this->coaModel->getPeriodeTahun();
        $data['nama_coa'] = $this->coaModel->getNamaAkun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/BukuBesar', $data);
    }

    //proses lihat buku besar
    public function lihatbukubesar(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['jurnal'] = $this->coaModel->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        
        
        $akun = $_POST['akun'];
        //explode untuk mendapatkan kode akun dan nama akun kode_akun|nama_akun
        $akuncacah = explode("|",$akun);
        //print_r($akuncacah);

        
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['kode_akun'] = $akuncacah[0];
        $data['nama_coa'] = $akuncacah[1];
        $data['bukubesar'] = $this->coaModel->getBukuBesar($data['tahun'], $data['bulan'], $data['kode_akun']);
        $data['saldoawal'] = $this->coaModel->getSaldoAwal($data['bulan'],$data['tahun'],$data['kode_akun']);
        $data['posisisaldonormal'] = $this->coaModel->getPosisiSaldoNormal($data['kode_akun']);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LihatBukuBesar', $data);
        
    }
    

    //laba rugi
    public function labarugi(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        $data['tahun'] = $this->CoaModel->getPeriodeTahun();

        //eksekusi pencatatan akrual jurnal
		$this->CoaModel->setPendapatanAkrual();

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LabaRugi', $data);
    }

    //proses lihat laba rugi
    public function lihatlabarugi(){
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['pendapatan'] = $this->CoaModel->getPendapatanOperasional($_POST['namakos'], $data['bulan'],$data['tahun']);
        $data['beban'] = $this->CoaModel->getBeban($_POST['namakos'],$data['bulan'],$data['tahun']);

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/LihatLabaRugi', $data);
        
    }
}    