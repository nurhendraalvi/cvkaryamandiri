<?php

namespace App\Controllers;

//load model database yang akan digunakan yaitu akun
use App\Models\AkunModel;

class Home extends BaseController
{
	public function __construct()
    {
		session_start();
        //load kelas AkunModel
        $this->akunmodel = new AkunModel();
    }

	public function index()
	{
		//return view('welcome_message');
		echo view('login');
	}

	public function ceklogin()
	{
		//$session = session();
		//echo $_POST['inputUsername'];
		//echo $_POST['inputPassword'];
		
		$hasil = $this->akunmodel->cekUsernamePwd();

		//iterasi hasil query
		foreach ($hasil as $row)
		{
			$jml = $row->jml;
		}
		
		//nilai jml adalah 1 menunjukkan bahwa pasangan username dan password cocok
		if($jml>0){	
			//update last login
			$hasil = $this->akunmodel->updatelastlogin();

			//dapatkan waktu last login
			$hasil = $this->akunmodel->getlastlogin($_POST['inputUsername']);
			//kembalikan hasil last_login yang tercatat di database
			foreach ($hasil as $row)
			{
				$lastlogin = $row->last_login;
			}

			// dapatkan kelompok user
			$hasil = $this->akunmodel->getGroupUser();
			foreach ($hasil as $row)
			{
				$kelompok = $row->user_group;
			}

			// dapatkan list daftar kosan jika pyg login adalah kelompok pemilik
			if($kelompok=='pemilik'){
				$hasil = $this->akunmodel->getListKosan($_POST['inputUsername']);
				foreach ($hasil as $row)
				{
					$daftarkosan = $row->daftarkosan;
				}
				$_SESSION['daftarkosan'] = $daftarkosan; // masukkan ke list daftarkosan 6,7 / 17
			}

			//ciptakan sesi untuk user
			$_SESSION['nama'] = $_POST['inputUsername'];
			$_SESSION['kelompok'] = $kelompok; // tambahkan kelompok pada session
			
			$_SESSION['lastlogin'] = $lastlogin;

			// Tambahan untuk akses berita menggunakan API
			$json = file_get_contents('https://newsapi.org/v2/top-headlines?country=id&apiKey=<<APPKEY_ANDA>>'); 
			$data['berita'] = json_decode($json);

			//jika pasangan sama maka diarahkan ke welcome page
			//return view('welcome_message');
			echo view('HeaderBootstrap');
			echo view('SidebarBootstrap');
			echo view('BodyBootstrap', $data);
		}else{
			//jika tidak sama maka dikembalikan ke ceklogin
			$data['pesan'] = 'Pasangan username dan password tidak tepat';
			return view('login', $data);
		}
		
	}

	//destroy session ketika logout
	public function logout()
	{
        //$this->session->destroy();
		session_destroy();
		return redirect()->to(base_url('home')); 
	}

	// coba input data melalui API
	public function inputDtSiswa(){
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		echo view('HeaderBootstrap');
		echo view('SidebarBootstrap');

		if(isset($_POST['NIM'])){
			
			$url="https://vsgatuvwd02.000webhostapp.com/siswa";
			$data=array("NIM"=>$_POST['NIM'],"Nama"=>$_POST['Nama'], "JK"=>$_POST['JK']);
			
			$options = array(
						"http"=> array(
							"method"=>"POST",
							"header"=>"Content-Type: application/x-www-form-urlencoded",
							"content"=>http_build_query($data)
						)
			);
			
			$response=file_get_contents($url,false,stream_context_create($options));
			$_SESSION['pesan'] = json_decode($response);
			echo view('InputSiswa');
		}else{
			echo view('InputSiswa');
		}
		
		
	}

}
