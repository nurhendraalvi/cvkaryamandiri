<?php
namespace App\Controllers;

use App\Models\PenghuniModel;

class Penghuni extends BaseController
{
	public function __construct()
    {
        //load kelas PenghuniModel
        $this->PenghuniModel = new PenghuniModel();
    }

    //form input akan diakses dari index
    public function index()
	{
        //di cek dulu, agar validasi tidak terpicu pada saat awal method ini diakses
        if( !isset($_POST['ktp']) and !isset($_POST['nama']) and !isset($_POST['email']) and !isset($_POST['telepon']) )
        {
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Penghuni/InputPenghuni');
        }
        else
        {
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                        [
                            'ktp' => 'required|is_natural',
                            'nama' => 'required',
                            'email' => 'valid_email',
                            'telepon' => 'required|numeric|is_natural'
                        ],
                                [   // Errors
                                    'ktp' => [
                                        'required' => 'Nomor KTP tidak boleh kosong',
                                        'is_natural' => 'Nomor telepon harus dalam angka natural bukan minus (0 s/d 9)'
                                    ],
                                    'nama' => [
                                        'required' => 'Nama tidak boleh kosong'
                                    ],
                                    'email' => [
                                        'valid_email' => 'Email harus valid cth hendro@gmail.com'
                                    ],
                                    'telepon' => [
                                        'required' => 'Nomor telepon tidak boleh kosong',
                                        'numeric' => 'Nomor telepon harus angka',
                                        'is_natural' => 'Nomor telepon harus dalam angka natural bukan minus (0 s/d 9)'
                                    ]
                                ]
                    )
            ){
                //kirim data error ke views, karena ada isian yang tidak sesuai rules
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Penghuni/InputPenghuni',[
                    'validation' => $this->validator,
                ]);

            }
            else
            {
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                //panggil metod dari kosan model untuk diinputkan datanya
                $hasil = $this->PenghuniModel->insertData();
                return redirect()->to(base_url('penghuni/listpenghuni')); 
            }
        }
	}

    public function listpenghuni()
    {
        $data['penghuni'] = $this->PenghuniModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penghuni/ListPenghuniDatatables', $data);
    }
    public function editpenghuni($id)
    {
        $data['penghuni'] = $this->PenghuniModel->editData($id);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Penghuni/Editpenghuni', $data);
    }
    public function editpenghuniproses()
    {
        $id = $_POST['id'];
        $ktp = $_POST['ktp'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];

        $validation = \config\services::validation();

        if (! $this->validate(
            [
                'ktp' => 'required|is_natural',
                'nama' => 'required',
                'email' => 'valid_email',
                'telepon' => 'required|numeric'
            ],
                    [   // Errors
                        'ktp' => [
                            'required' => 'Nomor KTP tidak boleh kosong',
                            'is_natural' => 'Nomor telepon harus dalam angka natural bukan minus (0 s/d 9)'
                        ],
                        'nama' => [
                            'required' => 'Nama tidak boleh kosong'
                        ],
                        'email' => [
                            'valid_email' => 'Email harus valid cth hendro@gmail.com'
                        ],
                        'telepon' => [
                            'required' => 'Nomor telepon tidak boleh kosong',
                            'numeric' => 'Nomor telepon harus angka'
                        ]
                    ]
                            ))
                {
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('Penghuni/Editpenghuni',
                    [
                        'validation' => $this->validator,
                        'penghuni' => $this->PenghuniModel->editData($id)
                    ]);
                }
                else
                {
                    //panggil method dari penghuni model untuk diinputkan datanya
                    $hasil = $this->PenghuniModel->updateData();
                    if($hasil->connID->affected_rows>0)
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Sukses diupdate");
                        </script>
                        <?php
                    }
                    $data['penghuni'] = $this->PenghuniModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('Penghuni/listPenghuni', $data);
                }

    }
    public function deletepenghuni($id)
    {
        $this->PenghuniModel->deleteData($id);
        return redirect()->to(base_url('penghuni/Listpenghuni'));
    }

 
}