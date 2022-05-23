<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use App\Models\PembelianModel;

class Pembelian extends BaseController
{
    public function __construct()
    {
        //load kelas TransaksiModel
        $this->PembelianModel = new PembelianModel();
        $this->JurnalModel = new JurnalModel();
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
        //$vendor = $_GET['id_mainan'];
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if (!isset($_POST['id_mainan']) and !isset($_POST['nama_vendor']) and !isset($_POST['nama_mainan']) and !isset($_POST['stok_mainan']) and !isset($_POST['jumlah_mainan']) and !isset($_POST['harga_beli']) and !isset($_POST['total_pembelian'])) {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            //if (isset($_POST['id_mainan'])) {
                $vendor = $_POST['id_mainan'];
                $data['pembelian'] = $this->PembelianModel->ToyGetDataby($vendor);        
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembelian/InputPembelian', $data);
            //}
        } 
          else {
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (!$this->validate(
                [
                    'id_mainan' => 'required',
                    'nama_vendor' => 'required',
                    'nama_mainan' => 'required',
                    'jumlah_mainan' => 'required|numeric|is_natural',
                    'harga_beli' => 'required|numeric|is_natural',
                    'total_pembelian' => 'required|numeric|is_natural'
                ],
                [   // Errors
                    'id_mainan' => [
                        'required' => 'id mainan tidak boleh kosong'
                    ],
                    'nama_vendor' => [
                        'required' => 'Nama Vendor tidak boleh kosong'
                    ],
                    'nama_mainan' => [
                        'required' => 'Nama Mainan tidak boleh kosong'
                    ],
                    'jumlah_mainan' => [
                        'required' => 'Jumlah Mainan tidak boleh kosong',
                        'numeric' => 'Jumlah Mainan harus angka',
                        'is_natural' => 'Jumlah Mainan harus dalam angka natural bukan minus (0 s/d 9)'
                    ],
                    'harga_beli' => [
                        'required' => 'Harga Beli tidak boleh kosong',
                        'numeric' => 'Harga Beli harus angka',
                        'is_natural' => 'Harga Beli harus dalam angka natural bukan minus (0 s/d 9)'
                    ],'total_pembelian' => [
                        'required' => 'Total Pembelian tidak boleh kosong',
                        'numeric' => 'Total Pembelian harus angka',
                        'is_natural' => 'Total Pembelian harus dalam angka natural bukan minus (0 s/d 9)'
                    ]
                ]
            )) {
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                //$vendor = $_GET['id_mainan'];
                $vendor = $_POST['id_mainan'];
                $data = $this->PembelianModel->ToyGetDataby($vendor); 
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembelian/InputPembelian', [
                    'validation' => $this->validator,
                    'pembelian' => $data,
                ]);
            } else {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                $id = $_POST['id_mainan'];
                $data = $_POST['stock'] + $_POST['jumlah_mainan'];
                $this->PembelianModel->UbahDataMainan($data,$id);
                $hasil = $this->PembelianModel->insertData();
                
                $total_pembelian = $_POST['total_pembelian'];

                $debit = $this->JurnalModel->inputjurnal('401', 'Pembelian', 'debit', $total_pembelian);
                $kredit = $this->JurnalModel->inputjurnal('201', 'HUtang', 'kredit', $total_pembelian);
                

                return redirect()->to(base_url('Pembelian/listpembelian'));
            }
        }
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
