<?php
namespace App\Controllers;

use App\Models\CustomerModel;

class Customer extends BaseController
{
	public function __construct()
    {
        session_start();

        //load kelas PenghuniModel
        $this->CustomerModel = new CustomerModel();
    }

    //list data akan diakses dari index
    public function index()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['customer'] = $this->CustomerModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('customer/listcustomerDatatables', $data);
    }
    public function inputcustomer()
	{
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['nama_customer']) and !isset($_POST['alamat_customer']) and !isset($_POST['telepon_customer']) )
        {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('customer/inputcustomer');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                        [
                            'nama_customer' => 'required',
                            'alamat_customer' => 'required',
                            'telepon_customer' => 'required|is_natural'
                            
                        ],
                                [   // Errors
                                    'nama_customer' => [
                                        'required' => 'Nama tidak boleh kosong',
                                    ],
                                    'alamat_customer' => [
                                        'required' => 'Alamat tidak boleh kosong'
                                    ],
                                    'telepon_customer' => [
                                        'required' => 'Telepon tidak boleh kosong',
                                        'is_natural' => 'Telepon harus dalam angka natural bukan minus (0 s/d 9)'
                                    ]
                                ]
                    )
            ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('customer/inputcustomer',[
                    'validation' => $this->validator,
                ]);

            }else
            {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                $hasil = $this->CustomerModel->insertData();
                return redirect()->to(base_url('customer/listcustomer')); 
            }
        }
	}

    public function listcustomer()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['customer'] = $this->CustomerModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('customer/listcustomerDatatables', $data);
    }
    public function editcustomer($id_customer)
    {
        $data['customer'] = $this->CustomerModel->editData($id_customer);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('customer/editcustomer', $data);
    }
    public function editcustomerproses()
    {
        $id_customer = $_POST['id_customer'];
        $nama_customer = $_POST['nama_customer'];
        $alamat_customer = $_POST['alamat_customer'];
        $telepon_customer = $_POST['telepon_customer'];
        

        $validation = \config\services::validation();

        if (! $this->validate(
            [
                'nama_customer' => 'required',
                'alamat_customer' => 'required',
                'telepon_customer' => 'required|is_natural'
                
            ],
                    [   // Errors
                        'nama_customer' => [
                            'required' => 'Nama tidak boleh kosong',
                        ],
                        'alamat_customer' => [
                            'required' => 'Alamat tidak boleh kosong'
                        ],
                        'telepon_customer' => [
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
                    echo view('customer/editcustomer',
                    [
                        'validation' => $this->validator,
                        'customer' => $this->CustomerModel->editData($id_customer)
                    ]);
                }
                else
                {
                    //panggil method dari penghuni model untuk diinputkan datanya
                    $hasil = $this->CustomerModel->updateData();
                    if($hasil->connID->affected_rows>0)
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Sukses diupdate");
                        </script>
                        <?php
                    }
                    $data['customer'] = $this->CustomerModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('customer/listcustomerDatatables', $data);
                }
    }
    public function deletecustomer($id_customer)
    {
        $this->CustomerModel->deleteData($id_customer);
        return redirect()->to(base_url('customer/listcustomer'));
    }

}    