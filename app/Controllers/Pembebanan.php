<?php
namespace App\Controllers;

use App\Models\PembebananModel;
use App\Models\KosanModel;

class Pembebanan extends BaseController
{
    public function __construct()
    {
        session_start();
        $this->PembebananModel = new PembebananModel();
        $this->kosanmodel = new KosanModel();
        helper('rupiah');
    }

	public function tambahbeban()
	{
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        if( !isset($_POST['nama']) and !isset($_POST['biaya']) and !isset($_POST['waktu']) ) {
            //tidak perlu divalidasi
            $data['pembebanan'] = $this->PembebananModel->getBebanData();
            $data['koskosan'] = $this->kosanmodel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pembebanan/InputPembebanan', $data);
        }else{
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                    [
                        'nama' => 'required',
                        'biaya' => 'required',
                        'waktu' => 'required'
                    ],
                    [   // Errors
                        'namakosan' => [
                            'required' => 'Nama beban tidak boleh kosong'
                        ],
                        'biaya' => [
                            'required' => 'Besar biaya beban tidak boleh kosong'
                        ],
                        'waktu' => [
                            'required' => 'Tanggal beban tidak boleh kosong'
                        ]
                    ]
                )
            ){
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembebanan/InputPembebanan',[
                    'validation' => $this->validator,
                    'pembebanan' => $this->PembebananModel->getBebanData(),
                    'koskosan' => $this->kosanmodel->getAll()
                ]);
            }else{
                //maka input database
                $hasil = $this->PembebananModel->inputBeban();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses menambahkan beban");
                    </script>
                    <?php	
                }
                $data['beban'] = $this->PembebananModel->getListBeban();
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembebanan/LihatBeban', $data);
            }
        }


	}
}