<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use App\Models\PembelianModel;
use App\Models\MainanModel;

class Pembelian extends BaseController
{
    public function __construct()
    {
        //load kelas TransaksiModel
        $this->PembelianModel = new PembelianModel();
        $this->JurnalModel = new JurnalModel();
        $this->MainanModel = new MainanModel();
    }

    public function index()
    {
        $data['pembelian'] = $this->PembelianModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/ListPembelian', $data);
    }
 
    public function VendorList()
    {
        $data['pembelian'] = $this->PembelianModel->ToyGetData();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/ListVendorBuy', $data);
    }
    public function SellForm($vendor)
    {
        $data['pembelian'] = $this->PembelianModel->ToyGetDataby($vendor);        
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/InputPembelian', $data);
    }

    //form input akan diakses dari index
    public function inputdata()
    {
                $id = $_POST['id_mainan'];
                $nm = $_POST['nama_mainan'];
                $stock = $_POST['stock'];
                $jml = $_POST['jumlah_mainan'];
                $harga_beli = $_POST['harga_beli'];
                $data = (int)$stock + (int)$jml;
                $tp = (int)$harga_beli * (int)$jml;
                $this->MainanModel->InsertMasuk($id, $nm, $jml);
                $this->PembelianModel->UbahDataMainan($data,$id);
                $this->PembelianModel->InsertJurnal2($tp);
                $hasil = $this->PembelianModel->insertData();
                //$total_pembelian = $_POST['total_pembelian'];

                $debit = $this->JurnalModel->inputjurnal('401', 'Pembelian', 'debit', $tp);
                $kredit = $this->JurnalModel->inputjurnal('201', 'HUtang', 'kredit', $tp);
                

                return redirect()->to(base_url('Pembelian/listpembelian'));
    }

    public function dummy2()
    {
        $id = $_POST['id_mainan'];
        $data = (int)$_POST['stock'] + (int)$_POST['total'];
        $this->PembelianModel->UbahDataMainan($data,$id);
        $this->PembelianModel->insertData2();
        return redirect()->to(base_url('Pembelian/VendorList'));
    }

    public function lihat_pembelian()
    {
        $data['pembelian'] = $this->PembelianModel->getAll();
        //maka kembalikan ke awal
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/LihatPembelian', $data);
    }

    public function listpembelian()
    {
        $data['pembelian'] = $this->PembelianModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembelian/ListPembelian', $data);
    }

    // public function pembayaran($id)
    // {
    //     $hasil = $this->PemesananModel->pembayaran($id); 

    //     $bayar = $_POST['bayar'] + $_POST['biaya_masuk'];

    //     $debit = $this->JurnalModel->inputjurnal('401', 'Pemesanan', 'debit', $bayar);
    //     $kredit = $this->JurnalModel->inputjurnal('111', 'Kas', 'kredit', $bayar);
        

    //     return redirect()->to(base_url('Pemesanan/listPemesanan'));
    // }

    // public function lihat_pembayaran()
    // {
    //     $data['pemesanan'] = $this->PemesananModel->getAll();
    //     //maka kembalikan ke awal
    //     echo view('HeaderBootstrap');
    //     echo view('SidebarBootstrap');
    //     echo view('Pemesanan/LihatPembayaran', $data);
    // }
}
