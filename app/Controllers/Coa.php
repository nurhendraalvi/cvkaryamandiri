<?php
namespace App\Controllers;

use App\Models\COAModel;

class Coa extends BaseController
{
	public function __construct()
    {
        session_start();

        //load kelas PenghuniModel
        $this->COAModel = new COAModel();
    }

    //list data akan diakses dari index
    public function index()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['coa'] = $this->COAModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('coa/listCOADatatables', $data);
    }
    public function inputcoa()
	{
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['kode_coa']) and !isset($_POST['nama_coa']) )
        {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('coa/inputcoa');
        }
        else{
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                        [
                            'kode_coa' => 'required|is_natural',
                            'nama_coa' => 'required',
                            
                        ],
                                [   // Errors
                                    'kode_coa' => [
                                        'required' => 'Kode COA tidak boleh kosong',
                                        'is_natural' => 'Kode COA harus dalam angka natural bukan minus (0 s/d 9)'
                                    ],
                                    'nama_coa' => [
                                        'required' => 'Nama tidak boleh kosong'
                                    ]
                                ]
                    )
            ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('coa/inputcoa',[
                    'validation' => $this->validator,
                ]);

            }else
            {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                $hasil = $this->COAModel->insertData();
                return redirect()->to(base_url('coa/listCOA')); 
            }
        }
	}

    public function listCOA()
    {
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['coa'] = $this->COAModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('coa/ListCOA', $data);
        echo view('coa/listCOADatatables', $data);
    }
    public function editcoa($id)
    {
        $data['coa'] = $this->COAModel->editData($id);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('coa/editcoa', $data);
    }
    public function editcoaproses()
    {
        $id = $_POST['id'];
        $kode_coa = $_POST['kode_coa'];
        $nama_coa = $_POST['nama_coa'];
        

        $validation = \config\services::validation();

        if (! $this->validate(
            [
                'kode_coa' => 'required|is_natural',
                'nama_coa' => 'required',
                
            ],
                    [   // Errors
                        'kode_coa' => [
                            'required' => 'Nomor KTP tidak boleh kosong',
                            'is_natural' => 'Nomor telepon harus dalam angka natural bukan minus (0 s/d 9)'
                        ],
                        'nama_coa' => [
                            'required' => 'Nama tidak boleh kosong'
                        ],
                        
                    ]
                                )
                )
                {
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('coa/editcoa',
                    [
                        'validation' => $this->validator,
                        'coa' => $this->COAModel->editData($id)
                    ]);
                }
                else
                {
                    //panggil method dari penghuni model untuk diinputkan datanya
                    $hasil = $this->COAModel->updateData();
                    if($hasil->connID->affected_rows>0)
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Sukses diupdate");
                        </script>
                        <?php
                    }
                    $data['coa'] = $this->COAModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('coa/listCOADatatables', $data);
                }
    }
    public function deletecoa($id)
    {
        $this->COAModel->deleteData($id);
        return redirect()->to(base_url('coa/listCOA'));
    }

}    