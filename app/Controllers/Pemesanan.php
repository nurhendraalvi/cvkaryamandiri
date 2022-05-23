<?php
 
namespace App\Controllers;

use App\Models\JurnalModel;
use App\Models\PemesananModel;

class Pemesanan extends BaseController
{
    public function __construct()
    {
        //load kelas TransaksiModel
        $this->PemesananModel = new PemesananModel();
        $this->JurnalModel = new JurnalModel();
    }

    public function index()
    {
        $data['pemesanan'] = $this->PemesananModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pemesanan/ListPemesanan', $data);
    }

    //form input akan diakses dari index
    public function inputdata()
    {
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if (!isset($_POST['nama_pemesanan']) and !isset($_POST['total_pemesanan']) and !isset($_POST['total_bayar'])) {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pemesanan/InputPemesanan');
        } else {
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (!$this->validate(
                [
                    'nama_pemesanan' => 'required',
                    'total_pemesanan' => 'required|numeric|is_natural',
                    'total_bayar' => 'required|numeric|is_natural'
                ],
                [   // Errors
                    'nama_pemesanan' => [
                        'required' => 'Nama pesanan tidak boleh kosong'
                    ],
                    'total_pemesanan' => [
                        'required' => 'Harga pesanan tidak boleh kosong',
                        'numeric' => 'Harga pesanan harus angka',
                        'is_natural' => 'Harga pesanan harus dalam angka natural bukan minus (0 s/d 9)'
                    ],
                    'total_bayar' => [
                        'required' => 'Total bayar tidak boleh kosong',
                        'numeric' => 'Total bayar harus angka',
                        'is_natural' => 'Total bayar harus dalam angka natural bukan minus (0 s/d 9)'
                    ]
                ]
            )) {
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pemesanan/InputPemesanan', [
                    'validation' => $this->validator,
                ]);
            } else {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                $hasil = $this->PemesananModel->insertData();
                
                $total_pemesanan = $_POST['total_pemesanan'];

                $debit = $this->JurnalModel->inputjurnal('401', 'Pemesanan', 'debit', $total_pemesanan);
                $kredit = $this->JurnalModel->inputjurnal('201', 'HUtang', 'kredit', $total_pemesanan);
                

                return redirect()->to(base_url('Pemesanan/listpemesanan'));
            }
        }
    }

    public function lihat_pemesanan()
    {
        $data['pemesanan'] = $this->PemesananModel->getAll();
        //maka kembalikan ke awal
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pemesanan/LihatPemesanan', $data);
    }

    public function listpemesanan()
    {
        $data['pemesanan'] = $this->PemesananModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pemesanan/ListPemesanan', $data);
    }

    public function pembayaran($id)
    {
        $hasil = $this->PemesananModel->pembayaran($id); 

        $bayar = $_POST['bayar'] + $_POST['biaya_masuk'];

        $debit = $this->JurnalModel->inputjurnal('401', 'Pemesanan', 'debit', $bayar);
        $kredit = $this->JurnalModel->inputjurnal('111', 'Kas', 'kredit', $bayar);
        

        return redirect()->to(base_url('Pemesanan/listPemesanan'));
    }

    public function lihat_pembayaran()
    {
        $data['pemesanan'] = $this->PemesananModel->getAll();
        //maka kembalikan ke awal
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pemesanan/LihatPembayaran', $data);
    }
}
