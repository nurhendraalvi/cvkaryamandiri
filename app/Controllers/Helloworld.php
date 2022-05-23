<?php
namespace App\Controllers;

use App\Models\KosanModel;
use App\Models\ForminputModel;
use App\Models\PembayaranModel;

class Helloworld extends BaseController
{
	public function __construct()
    {
        //load kelas AkunModel
        $this->kosanmodel = new KosanModel();

        //load kelas form input model
        $this->ForminputModel = new ForminputModel();
        $this->PembayaranModel = new PembayaranModel();
        session_start();
    }

    public function index()
	{
		echo "Hello World";
	}

    public function comment(){
        echo "Contoh method";
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }else{
            echo $_SESSION['nama'];
        }
        
    }

    public function sapaan($nama, $kelas){
        echo "Nama saya sadalah = ".$nama;
        echo "<br>";
        echo "Kelas saya adalah = ".$kelas;
        echo "<br>";
        //echo img('https://cdn.idntimes.com/content-images/post/20181111/shutterstock-633111986-2b536236c6f6e691ec05cd45253656e9_600x400.jpg');
        echo img('images/gunung.jpg');
        //echo img('images/gunung.jpg');
    }

    public function aksesdb(){
        $data['koskosan'] = $this->kosanmodel->getAll();
        echo view('lihatkosan', $data);
    }

    public function cek(){
        //echo view('tes');
        //echo view('tes2');
        $data['koskosan'] = $this->kosanmodel->getAll();

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        //echo view('kosan/tes', $data);
        echo view('kosan/Daftarkosan', $data);
    }

    public function cekboostrap(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('BodyBootstrap');
    }

    public function tesmodal(){
        echo view('tes2');
    }

    public function cekmodal(){
        $data['koskosan'] = $this->kosanmodel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('tes5', $data);
    }

    public function teslistgroup(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('tes2');
    }

    public function tesdatehelper(){
        helper('date');
        echo now('Australia/Victoria');
    }

    public function teshelpernumber(){
        helper('number');
        echo number_to_amount(123456); // Returns 123 thousand
        echo "<br>";
        echo number_to_size(3456789); // Returns 3.3 MB
    } 

    public function teshelperrupiah(){
        helper('rupiah');
        $hargajual = 123400550;
        echo "Tanpa Helper = ".$hargajual."<br>";
        echo "Dengan Helper = ".rupiah($hargajual)."<br>";
        echo "Dengan Helper = ".terbilang($hargajual)."<br>"; 
    }

    public function teshelperwaktu(){
        helper('waktu');
        $last_login = '2021-01-27 18:24:27';

        echo "Login terakhir = ".$last_login."<br>";
        echo "Login terakhir sudah ".selisih($last_login)." dari sekarang <br>";
    }

    public function tes_session(){
        //$session = session();
        $this->session->set('nama', 'bambang');
        echo $this->session->nama;
    }

    public function tes_isi_session(){
        $session = session();
       echo $session->nama;

    }

    public function tes_destroy_session(){
        $session = session();
        $session->destroy();
        echo "sesi sudah terdestroy";
        echo $session->nama;

     }

    public function tes_datatables(){
        echo view('tes');
    }

    public function tes_datatables5(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('tes4');
    }

    public function tes_datepicker(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('tesdatepicker');
    }

    public function tes_masking(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('tesMasking');
    }

    public function hasil_submit_masking(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        $data['harga'] = $_POST['harga'];
        $data['telepon'] = $_POST['telepon'];
        echo view('tesHasilMasking', $data);
    }

    public function tessdsd(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('ViewFormInput');
    }

    public function inputForm(){
        //cek apakah sudah diisi semua, jika kosong semua maka tidak perlu panggil validasi
        if( !isset($_POST['gambar']) and !isset($_POST['dokumen']) and
            !isset($_POST['tanggal']) and !isset($_POST['waktu']) and
            !isset($_POST['gender']) and !isset($_POST['hobi'])
        )
        {   
            //kondisi semua belum di isi, maka tampilkan form tanpa perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('ViewFormInput');    
        }else{
            //jika sudah ada yang diisi berarti sudah diakses dan user memasukkan input, maka perlu memanggil validasi
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                            [
                                'waktu' => 'required',
                                'tanggal' => 'required',
                                'gender' => 'required',
                                'gambar' => [
                                    'uploaded[gambar]',
                                    'mime_in[gambar,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                                    'max_size[gambar,1024]', //maksimal 1 M
                                ],
                                'dokumen' => [
                                    'uploaded[dokumen]',
                                    'mime_in[dokumen,application/pdf]', //dibatasi haya pdf
                                    'max_size[dokumen,10240]', //maksimal 10 M
                                ]
                            ],
                                    [   // Errors
                                        'waktu' => [
                                            'required' => 'Waktu tidak boleh kosong'
                                        ],
                                        'tanggal' => [
                                            'required' => 'Tanggal tidak boleh kosong'
                                        ],
                                        'gender' => [
                                            'required' => 'Jenis kelamin tidak boleh kosong'
                                        ]
                                    ]
                   )
            ){
                //kembalikan list error ke views
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('ViewFormInput',[
                    'validation' => $this->validator,
                ]);
            }else{
                //proses upload file ke server dulu
                //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
                $fileName = uniqid();

                //mendapatkan nama file asli untuk gambar
                $namafileasli = $_FILES['gambar']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_gbr_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $gbr = $fileName.'.'.$ekstensi_file_gbr_asli;

                //mendapatkan nama file asli untuk dokumen
                $namafileasli = $_FILES['dokumen']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_dokumen_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $dok = $fileName.'.'.$ekstensi_file_dokumen_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('gambar');
                $avatar->move(ROOTPATH.'public/images/upload', $gbr); //namafile u12adsasds + . + jpg

                //mengupload ke server ke lokasi public/dokumen/upload
                $avatar = $this->request->getFile('dokumen');
                $avatar->move(ROOTPATH.'public/dokumen/upload', $dok); //namafile u12adsasds + . + pdf


                //validasi tidak menemukan error sehingga bisa langsung di submit ke database
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                $hasil = $this->ForminputModel->insertData($dok, $gbr);
                return redirect()->to(base_url('helloworld/hasilinputform')); 
            }
        } 

        
    }

    public function editForm($id){
        
        $data['form_input'] = $this->ForminputModel->getDataById($id);
        $data['form_input_detail'] = $this->ForminputModel->getDataDetailById($id);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('ViewFormEdit', $data);
    }

    public function ediformproses(){

        $dokumen_lama = $_POST['old_dokumen']; //menyimpan nilai lama dokumen
        $gambar_lama = $_POST['old_gambar']; //menyimpan nilai lama gambar

        $form_input = $this->ForminputModel->getDataById($_POST['id']);
        $form_input_detail = $this->ForminputModel->getDataDetailById($_POST['id']);

        $validation =  \Config\Services::validation();

        //jika input gambar diisi oleh user
        if( !empty($_FILES["gambar"]["name"]) and empty($_FILES["dokumen"]["name"]) ){
            $input = $this->validate(
                [
                    'waktu' => 'required',
                    'tanggal' => 'required',
                    'gender' => 'required',
                    'gambar' => [
                        'uploaded[gambar]',
                        'mime_in[gambar,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[gambar,1024]', //maksimal 1 M
                    ]
                ],
                        [   // Errors
                            'waktu' => [
                                'required' => 'Waktu tidak boleh kosong'
                            ],
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong'
                            ],
                            'gender' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'
                            ]
                        ]
            );
        }
        //jika input dokumen diisi oleh user
        if( !empty($_FILES["dokumen"]["name"]) and empty($_FILES["gambar"]["name"]) ){
            $input = $this->validate(
                [
                    'waktu' => 'required',
                    'tanggal' => 'required',
                    'gender' => 'required',
                    'dokumen' => [
                        'uploaded[dokumen]',
                        'mime_in[dokumen,application/pdf]', //dibatasi haya pdf
                        'max_size[dokumen,10240]', //maksimal 10 M
                    ]
                ],
                        [   // Errors
                            'waktu' => [
                                'required' => 'Waktu tidak boleh kosong'
                            ],
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong'
                            ],
                            'gender' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'
                            ]
                        ]
            );
        }
        //jika input gambar dan dokumen diisi oleh user
        if( !empty($_FILES["dokumen"]["name"]) and !empty($_FILES["gambar"]["name"]) ){
            $input = $this->validate(
                [
                    'waktu' => 'required',
                    'tanggal' => 'required',
                    'gender' => 'required',
                    'gambar' => [
                        'uploaded[gambar]',
                        'mime_in[gambar,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[gambar,1024]', //maksimal 1 M
                    ],
                    'dokumen' => [
                        'uploaded[dokumen]',
                        'mime_in[dokumen,application/pdf]', //dibatasi haya pdf
                        'max_size[dokumen,10240]', //maksimal 10 M
                    ]
                ],
                        [   // Errors
                            'waktu' => [
                                'required' => 'Waktu tidak boleh kosong'
                            ],
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong'
                            ],
                            'gender' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'
                            ]
                        ]
            );
        }else{
            $input = $this->validate(
                [
                    'waktu' => 'required',
                    'tanggal' => 'required',
                    'gender' => 'required'
                ],
                        [   // Errors
                            'waktu' => [
                                'required' => 'Waktu tidak boleh kosong'
                            ],
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong'
                            ],
                            'gender' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'
                            ]
                        ]
            );
        }

        

        ///////////////
        if (! $input)
        {
            //kembalikan list error ke views
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('ViewFormEdit',[
                'validation' => $this->validator,
                'form_input' => $form_input,
                'form_input_detail' => $form_input_detail
            ]);
        }else{
            //proses upload file ke server dulu
            //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
            $fileName = uniqid();

            //cek apakah file dokumen diupdate
            if(!empty($_FILES["gambar"]["name"])){
                //mendapatkan nama file asli untuk gambar
                $namafileasli = $_FILES['gambar']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_gbr_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $gbr = $fileName.'.'.$ekstensi_file_gbr_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('gambar');
                $avatar->move(ROOTPATH.'public/images/upload', $gbr); //namafile u12adsasds + . + jpg
            }else{
                $gbr = $gambar_lama;
            }

            if(!empty($_FILES["dokumen"]["name"])){
                //mendapatkan nama file asli untuk dokumen
                $namafileasli = $_FILES['dokumen']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_dokumen_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $dok = $fileName.'.'.$ekstensi_file_dokumen_asli;

                //mengupload ke server ke lokasi public/dokumen/upload
                $avatar = $this->request->getFile('dokumen');
                $avatar->move(ROOTPATH.'public/dokumen/upload', $dok); //namafile u12adsasds + . + pdf
            }else{
                $dok = $dokumen_lama;
            }

            //validasi tidak menemukan error sehingga bisa langsung di submit ke database
            //blok ini adalah blok jika sukses, yaitu panggil method insertData()
            $hasil = $this->ForminputModel->updateData($dok, $gbr);
            return redirect()->to(base_url('helloworld/hasilinputform')); 
        }
        //////////////



    }

    public function hasilinputform(){
        $data['form_input'] = $this->ForminputModel->getData();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('ViewHasilFormInput', $data);  
    }
    
    //untuk hapus deleteforminput
    public function deleteforminput($id){
        
		$this->ForminputModel->deleteData($id);

		return redirect()->to(base_url('helloworld/hasilinputform')); 
	}

    public function tesPath(){
        echo ROOTPATH.'public/dokumen/upload/603b319d03dd8.pdf';
        echo "<br>";
        echo FCPATH.'/dokumen/upload/603b319d03dd8.pdf';
        unlink(FCPATH.'dokumen/upload/603b319d03dd8.pdf');
    }

    //tes array
    public function tesArray(){
        $data['koskosan'] = $this->kosanmodel->getAll();
        $ar = array();
        $i = 0;
        foreach($data['koskosan'] as $row):
            echo $row['id_kos']."<br>";
            array_push($ar, array($row['id_kos'],0,0,0));
            $i++;
        endforeach;
        print_r($ar);
        echo "<p>";
        //$ar[0][0] = 99999;

        echo "<p>";
        print_r($ar);
        echo "<hr>";
        echo "all = ".$this->kosanmodel->getInfoKamar($ar[0][0], 'all')."<br>";
        echo "Kosong = ".$this->kosanmodel->getInfoKamar($ar[0][0], 'Kosong')."<br>";
        echo "Kosong = ".$this->kosanmodel->getInfoKamar($ar[0][0], 'Isi')."<br>";
    }

    public function tesnokuitansi(){
        $nokuitansi = $this->PembayaranModel->getNoKuitansi(6);
        echo $nokuitansi;
        echo "<br>";
        echo date("Ymd");
    }

    public function tesvalidasi(){
        if(isset($_POST['namakosan'])){
            $validation =  \Config\Services::validation();

            if (! $this->validate(
                        [
                                'namakosan' => 'required'
                        ],
                                [   // Errors
                                    'namakosan' => [
                                        'required' => 'Nama kosan tidak boleh kosong',
                                    ]
                                ]
                )
            ){
                //jika ada error
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('tes',[
                    'validation' => $this->validator,
                ]);

            }else{
                //jika tidak ada error
            }
        }
        else{    
            //echo $_POST['namakos'];
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('tes');
        }  
    }

    //untuk mencoba nomor kuitansi otomatis
    public function tesnomorkuitansiotomatis(){
        $data['koskosan'] = $this->kosanmodel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Viewtabelkosan', $data);
    }

    public function formkuitansi($id_kos){
        //panggil method generate kuitansi
        $nokuitansi = $this->PembayaranModel->getNoKuitansi($id_kos);
        $data['id_kos'] = $id_kos;
        $data['nokuitansi'] = $nokuitansi;
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('InputKuitansi', $data);
    }

    public function getformkuitansi(){
        if(isset($_POST['nomorkuitansi1'])){
            echo 'isi nomor kuitansi1 = '.$_POST['nomorkuitansi'];
        }
        echo "<br>";
        if(isset($_POST['nomorkuitansi2'])){
            echo 'isi nomor kuitansi2 = '.$_POST['nomorkuitansi2'];
        }
    }

    //mencoba DOM
    public function cobadomgantiwarna(){
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('gantiwarna');
    }
    
    //mencobca DOM PDF
    public function laporan_pdf(){

        $data['koskosan'] = $this->kosanmodel->getAll();
        $html = view('lihatkosan', $data);

        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
