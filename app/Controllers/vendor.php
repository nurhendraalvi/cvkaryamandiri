<?php
namespace App\Controllers;
 
use App\Models\VendorModel;

class Vendor extends BaseController
{
	public function __construct()
    {
        session_start();

        //load kelas PenghuniModel
        $this->VendorModel = new VendorModel();
    }

    //list data akan diakses dari index
    public function index()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['vendor'] = $this->VendorModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('vendor/listvendorDatatables', $data);
    }
    public function inputvendor()
	{
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['nama_vendor']) and !isset($_POST['alamat_vendor']) and !isset($_POST['no_telp_vendor']) )
        {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('vendor/inputvendor');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                        [
                            'nama_vendor' => 'required',
                            'alamat_vendor' => 'required',
                            'no_telp_vendor' => 'required|is_natural'
                            
                        ],
                                [   // Errors
                                    'nama_vendor' => [
                                        'required' => 'Nama tidak boleh kosong',
                                    ],
                                    'alamat_vendor' => [
                                        'required' => 'Alamat tidak boleh kosong'
                                    ],
                                    'no_telp_vendor' => [
                                        'required' => 'Telepon tidak boleh kosong',
                                        'is_natural' => 'Telepon harus dalam angka natural bukan minus (0 s/d 9)'
                                    ]
                                ]
                    )
            ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('vendor/inputvendor',[
                    'validation' => $this->validator,
                ]);

            }else
            {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                $hasil = $this->VendorModel->insertData();
                return redirect()->to(base_url('vendor/listvendor')); 
            }
        }
	}

    
    public function listvendor()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['vendor'] = $this->VendorModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('vendor/listvendorDatatables', $data);
    }
    public function editvendor($id_vendor)
    {
        $data['vendor'] = $this->VendorModel->editData($id_vendor);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('vendor/editvendor', $data);
    }
    public function editvendorproses()
    {
        $id_vendor = $_POST['id_vendor'];
        $nama_vendor = $_POST['nama_vendor'];
        $alamat_vendor = $_POST['alamat_vendor'];
        $no_telp_vendor = $_POST['no_telp_vendor'];
        

        $validation = \config\services::validation();

        if (! $this->validate(
            [
                'nama_vendor' => 'required',
                'alamat_vendor' => 'required',
                'no_telp_vendor' => 'required|is_natural'
                
            ],
                    [   // Errors
                        'nama_vendor' => [
                            'required' => 'Nama tidak boleh kosong',
                        ],
                        'alamat_vendor' => [
                            'required' => 'Alamat tidak boleh kosong'
                        ],
                        'no_telp_vendor' => [
                            'required' => 'Telepon tidak boleh kosong',
                            'is_natural' => 'Telepon harus dalam angka natural bukan minus (0 s/d 9)'
                        ]
                    ]
                                )
                )
                {
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('vendor/editvendor',
                    [
                        'validation' => $this->validator,
                        'vendor' => $this->VendorModel->editData($id_vendor)
                    ]);
                }
                else
                {
                    //panggil method dari penghuni model untuk diinputkan datanya
                    $hasil = $this->VendorModel->updateData();
                    if($hasil->connID->affected_rows>0)
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Sukses diupdate");
                        </script>
                        <?php
                    }
                    $data['vendor'] = $this->VendorModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('vendor/listvendorDatatables', $data);
                }
    }
    public function deletevendor($id_vendor)
    {
        $this->VendorModel->deleteData($id_vendor);
        return redirect()->to(base_url('vendor/listvendor'));
    }

}    