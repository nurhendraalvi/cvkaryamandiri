<?php
namespace App\Controllers;

use App\Models\MainanModel;
use App\Models\VendorModel;
 
class Mainan extends BaseController
{
    
	public function __construct()
    {
        session_start();

        //load kelas PenghuniModel
        $this->MainanModel = new MainanModel();
        $this->VendorModel = new VendorModel();
    }

    //list data akan diakses dari index
    public function index()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['mainan'] = $this->MainanModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('mainan/listmainanDatatables', $data);
    }
    public function inputmainan()
	{
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if(!isset($_POST['nama_vendor']) and !isset($_POST['nama_mainan']) and !isset($_POST['harga_beli']) and !isset($_POST['harga_jual']) and !isset($_POST['stok_mainan']) )
        {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            $data['vendor'] = $this->VendorModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('mainan/inputmainan', $data);
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                        [
                            'nama_vendor' => 'required',
                            'nama_mainan' => 'required',
                            'harga_beli' => 'required|is_natural',
                            'harga_jual' => 'required|is_natural',
                            'stok_mainan' => 'required|is_natural',
                            
                        ],
                                [   // Errors
                                    'nama_vendor' => [
                                        'required' => 'Nama Vendor tidak boleh kosong',
                                    ],
                                    'nama_mainan' => [
                                        'required' => 'Nama Mainan tidak boleh kosong',
                                    ],
                                    'harga_beli' => [
                                        'required' => 'Harga Beli tidak boleh kosong',
                                        'is_natural' => 'Harga Beli harus dalam angka natural bukan minus (0 s/d 9)'
                                    ],
                                    'harga_jual' => [
                                        'required' => 'Harga Jual tidak boleh kosong',
                                        'is_natural' => 'Harga Jual harus dalam angka natural bukan minus (0 s/d 9)'
                                    ],
                                    'stok_mainan' => [
                                        'required' => 'Stok Mainan tidak boleh kosong',
                                        'is_natural' => 'Stok Mainan harus dalam angka natural bukan minus (0 s/d 9)'
                                    ]
                                ]
                    )
            ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('mainan/inputmainan',[
                    'validation' => $this->validator,
                ]);

            }else
            {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                
                //$this->VendorModel->insertData2();
                $hasil = $this->MainanModel->insertData();
                return redirect()->to(base_url('mainan/listmainan')); 
            }
        }
	}

    public function listmainan()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['mainan'] = $this->MainanModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('mainan/listmainanDatatables', $data);
    }

    public function ViewStockCard($id_mainan)
    {
        $data['mainan'] = $this->MainanModel->GetStockCard($id_mainan);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('mainan/StockCard', $data);
    }

    public function editmainan($id_mainan)
    {
        $data['mainan'] = $this->MainanModel->editData($id_mainan);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('mainan/editmainan', $data);
    }
    public function editmainanproses()
    {
        $id_mainan = $_POST['id_mainan'];
        $nama_vendor =$_POST['nama_vendor'];
        $nama_mainan = $_POST['nama_mainan'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok_mainan =  $_POST['stok_mainan'];
        

        $validation = \config\services::validation();

        if (! $this->validate(
            [
                'nama_vendor' => 'required',
                'nama_mainan' => 'required',
                'harga_beli' => 'required|is_natural',
                'harga_jual' => 'required|is_natural',
                'stok_mainan' => 'required|is_natural',
                
            ],
                    [   // Errors
                        'nama_vendor' => [
                            'required' => 'Nama tidak boleh kosong',
                        ],
                        'nama_mainan' => [
                            'required' => 'Nama tidak boleh kosong',
                        ],
                        'harga_beli' => [
                            'required' => 'Harga Beli tidak boleh kosong',
                            'is_natural' => 'Harga Beli harus dalam angka natural bukan minus (0 s/d 9)'
                        ],
                        'harga_jual' => [
                            'required' => 'Harga Jual tidak boleh kosong',
                            'is_natural' => 'Harga Jual harus dalam angka natural bukan minus (0 s/d 9)'
                        ],
                        'stok_mainan' => [
                            'required' => 'Stok Mainan tidak boleh kosong',
                            'is_natural' => 'Stok Mainan harus dalam angka natural bukan minus (0 s/d 9)'
                        ]
                    ]
                                )
                )
                {
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('mainan/editmainan',
                    [
                        'validation' => $this->validator,
                        'mainan' => $this->MainanModel->editData($id_mainan)
                    ]);
                }
                else
                {
                    //panggil method dari penghuni model untuk diinputkan datanya
                    $hasil = $this->MainanModel->updateData();
                    if($hasil->connID->affected_rows>0)
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Sukses diupdate");
                        </script>
                        <?php
                    }
                    $data['mainan'] = $this->MainanModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('mainan/listmainanDatatables', $data);
                }
    }
    public function deletemainan($id_mainan)
    {
        $this->MainanModel->deleteData($id_mainan);
        return redirect()->to(base_url('mainan/listmainan'));
    }

    

}    