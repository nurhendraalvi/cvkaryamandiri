<?php
namespace App\Controllers;

//use App\Models\KosanModel;
use App\Models\PemesananModel;
use App\Models\PembayaranModel;
//use App\Models\PenghuniModel;

class Pembayaran extends BaseController
{
	public function __construct()
    {
        session_start();
        //$this->kosanmodel = new KosanModel();
        $this->PemesananModel = new PemesananModel();
        $this->PembayaranModel = new PembayaranModel();
        //$this->PenghuniModel = new PenghuniModel();
    }

    public function index()
	{
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $data['koskosan'] = $this->kosanmodel->getAll();
        //mengisi array dua dimensi dengan pola [0]= id kosan, [1]  = jml kamar, [2] jml kamar terisi, [3] jml kamar kosong
        //Array ( [0] => Array ( [0] => 6 [1] => 0 [2] => 0 [3] => 0 ) 
        //[1] => Array ( [0] => 7 [1] => 0 [2] => 0 [3] => 0 ) 
        //[2] => Array ( [0] => 17 [1] => 0 [2] => 0 [3] => 0 ) )
        $ar = array();
        $i = 0;
        foreach($data['koskosan'] as $row):
            array_push($ar, array($row['id_kos'],0,0,0)); //inisialisasi array [1],[2],[3] dengan 0
            $i++;
        endforeach;

        for($i=0;$i<count($ar);$i++){
            $ar[$i][1] = $this->kosanmodel->getInfoKamar($ar[$i][0], 'all');
            $ar[$i][2] = $this->kosanmodel->getInfoKamar($ar[$i][0], 'Isi');
            $ar[$i][3] = $this->kosanmodel->getInfoKamar($ar[$i][0], 'Kosong');
        }
        //hasil array jumlah data kosan
        $data['infokosan'] = $ar;

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembayaran/Daftarkosan', $data);
	}

    //listkamar
    public function listkamar($id, $kos){
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        $hasil = $this->PembayaranModel->getInfoPembayaranPerKamar($id);
        $data['kamar'] = $hasil;

        //print_r($hasil);
        $data['idkos'] = $id;
        $data['namakos'] = $kos;
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembayaran/ListKamar', $data);
    }

    //list history pembayaran berdasarkan id kamar tertentu
    public function listpembayaran($id_kamar){
        helper('rupiah');
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
        //getHistoryPembayaranByIdKamar($id_kamar)
        $data['pembayaran'] = $this->PembayaranModel->getHistoryPembayaranByIdKamar($id_kamar);

        $totalbayar = 0; $sisa_bayar= 0;
        foreach($data['pembayaran'] as $row):
            $id_pesan = $row->id_pesan;
            $id_kos = $row->id_kos;
            $nama_kos = $row->nama_kos;
            $kmr = $row->kmr;
            $harga_deal = $row->harga_deal;
            $totalbayar =  $totalbayar + $row->besar_bayar;
        endforeach;
        $sisa_bayar= $harga_deal-$totalbayar;

        $data['id_pesan'] = $id_pesan;
        $data['nama_kos'] = $nama_kos;
        $data['kmr'] = $kmr;
        $data['harga_deal'] = rupiah($harga_deal);
        $data['totalbayar'] = rupiah($totalbayar);
        $data['sisa_bayar'] = rupiah($sisa_bayar);

        //dapatkan nomor kuitansinya
        $nokuitansi = $this->PembayaranModel->getNoKuitansi($id_kos);
        $data['nokuitansi'] = $nokuitansi;

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembayaran/Listpembayaran', $data);

    }

    //method untuk memasukkan data pembayaran
    public function inputpembayaran($id_pesan,$nokuitansi,$nama_kos)
    {
        helper('rupiah');
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama']))
        {
            return redirect()->to(base_url('home')); 
        }

        //mencari nama kosan berdasarkan id_pesan
        $data['nama_kos'] = $nama_kos;

        $hasil= $this->PembayaranModel->getDataKamarByIdPesan($id_pesan);
        foreach($hasil as $row):
            $infokamar = 'Lt '.$row->lantai.' ('.$row->nomer.')';
            $tgl  = $row->tanggal_sekarang;
            $id_kamar = $row->id;
        endforeach;

        $data['infokamar'] = $infokamar;
        $data['tanggal'] = $tgl;

        //getHistoryPembayaranByIdKamar($id_kamar)
        $data['pembayaran'] = $this->PembayaranModel->getHistoryPembayaranByIdKamar($id_kamar);

        $totalbayar = 0; $sisa_bayar= 0;
        foreach($data['pembayaran'] as $row):
            $id_pesan = $row->id_pesan;
            $id_kos = $row->id_kos;
            $nama_kos = $row->nama_kos;
            $kmr = $row->kmr;
            $harga_deal = $row->harga_deal;
            $totalbayar =  $totalbayar + $row->besar_bayar;
        endforeach;
        $sisa_bayar= $harga_deal-$totalbayar;

        $data['id_pesan'] = $id_pesan;
        $data['harga_deal'] = rupiah($harga_deal);
        $data['totalbayar'] = rupiah($totalbayar);
        $data['sisa_bayar'] = rupiah($sisa_bayar);
        $data['nokuitansi'] =$nokuitansi;

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembayaran/Inputpembayaran', $data);
    }

    //method untuk memasukkan data pembayaran
    public function inputpembayaranpg($id_pesan,$nokuitansi,$nama_kos){
        helper('rupiah');
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        //mencari nama kosan berdasarkan id_pesan
        $data['nama_kos'] = $nama_kos;

        $hasil= $this->PembayaranModel->getDataKamarByIdPesan($id_pesan);
        foreach($hasil as $row):
            $infokamar = 'Lt '.$row->lantai.' ('.$row->nomer.')';
            $tgl  = $row->tanggal_sekarang;
            $id_kamar = $row->id;
        endforeach;

        $data['infokamar'] = $infokamar;
        $data['tanggal'] = $tgl;

        //getHistoryPembayaranByIdKamar($id_kamar)
        $data['pembayaran'] = $this->PembayaranModel->getHistoryPembayaranByIdKamar($id_kamar);

        $totalbayar = 0; $sisa_bayar= 0;
        foreach($data['pembayaran'] as $row):
            $id_pesan = $row->id_pesan;
            $id_kos = $row->id_kos;
            $nama_kos = $row->nama_kos;
            $kmr = $row->kmr;
            $harga_deal = $row->harga_deal;
            $totalbayar =  $totalbayar + $row->besar_bayar;
        endforeach;
        $sisa_bayar= $harga_deal-$totalbayar;

        $data['id_pesan'] = $id_pesan;
        $data['harga_deal'] = rupiah($harga_deal);
        $data['totalbayar'] = rupiah($totalbayar);
        $data['sisa_bayar'] = rupiah($sisa_bayar);
        $data['nokuitansi'] =$nokuitansi;

        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembayaran/Inputpembayaranpg', $data);
    }

    public function prosespembayaran(){
        helper('rupiah');
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        ///////////////
        //mencari nama kosan berdasarkan id_pesan
        $data['nama_kos'] = $_POST['nama_kos'];

        $hasil= $this->PembayaranModel->getDataKamarByIdPesan($_POST['id_pemesanan']);
        foreach($hasil as $row):
            $infokamar = 'Lt '.$row->lantai.' ('.$row->nomer.')';
            $tgl  = $row->tanggal_sekarang;
            $id_kamar = $row->id;
        endforeach;

        $data['infokamar'] = $infokamar;
        $data['tanggal'] = $tgl;

        //getHistoryPembayaranByIdKamar($id_kamar)
        $data['pembayaran'] = $this->PembayaranModel->getHistoryPembayaranByIdKamar($id_kamar);

        $totalbayar = 0; $sisa_bayar= 0;
        foreach($data['pembayaran'] as $row):
            $id_pesan = $row->id_pesan;
            $id_kos = $row->id_kos;
            $nama_kos = $row->nama_kos;
            $kmr = $row->kmr;
            $harga_deal = $row->harga_deal;
            $totalbayar =  $totalbayar + $row->besar_bayar;
        endforeach;
        $sisa_bayar= $harga_deal-$totalbayar;

        $data['id_pesan'] = $id_pesan;
        $data['harga_deal'] = rupiah($harga_deal);
        $data['totalbayar'] = rupiah($totalbayar);
        $data['sisa_bayar'] = rupiah($sisa_bayar);
        $data['nokuitansi'] =$_POST['no_kuitansi'];
        //////////////

        //cek dulu apakah sudah ada datanya
        if(isset($_POST['besar_bayar'])){
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                        [
                                'besar_bayar' => 'required'
                        ],
                                [   // Errors
                                    'besar_bayar' => [
                                        'required' => 'Besar pembayaran tidak boleh kosong'
                                    ]
                                ]
                )
            )
            {
                //jika validasi menemukan error
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembayaran/Inputpembayaran',[
                        'validation' => $this->validator,
                        'nama_kos' => $data['nama_kos'],
                        'infokamar' => $data['infokamar'],
                        'tanggal' => $data['tanggal'],
                        'id_pesan' => $data['id_pesan'],
                        'harga_deal' => $data['harga_deal'],
                        'totalbayar' => $data['totalbayar'],
                        'sisa_bayar' => $data['sisa_bayar'],
                        'nokuitansi' => $data['nokuitansi']

                    ]);
            }else{
                //jika validasi tidak menemukan error
                $hasil = $this->PembayaranModel->inputDataPembayaran($_POST['id_pemesanan'],$this->PembayaranModel->getNoKuitansi($id_kos));
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses ditambahkan");
                    </script>
                    <?php	
                }
                $data['kmr'] = $kmr;
                $data['pembayaran'] = $this->PembayaranModel->getHistoryPembayaranByIdKamar($id_kamar);

                $totalbayar = 0; $sisa_bayar= 0;
                foreach($data['pembayaran'] as $row):
                    $id_pesan = $row->id_pesan;
                    $id_kos = $row->id_kos;
                    $nama_kos = $row->nama_kos;
                    $kmr = $row->kmr;
                    $harga_deal = $row->harga_deal;
                    $totalbayar =  $totalbayar + $row->besar_bayar;
                endforeach;
                $sisa_bayar= $harga_deal-$totalbayar;

                $data['id_pesan'] = $id_pesan;
                $data['nama_kos'] = $nama_kos;
                $data['kmr'] = $kmr;
                $data['harga_deal'] = rupiah($harga_deal);
                $data['totalbayar'] = rupiah($totalbayar);
                $data['sisa_bayar'] = rupiah($sisa_bayar);

                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembayaran/Listpembayaran', $data);
            }   

        }else{
            //tidak perlu dicek
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pembayaran/Inputpembayaran', $data);
        }
    }

    // Proses Pembayaran Menggunakan Payment Gateway
    public function prosespembayaranpg(){
        helper('rupiah');
        //tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

        ///////////////
        //mencari nama kosan berdasarkan id_pesan
        $data['nama_kos'] = $_POST['nama_kos'];

        $hasil= $this->PembayaranModel->getDataKamarByIdPesan($_POST['id_pemesanan']);
        foreach($hasil as $row):
            $infokamar = 'Lt '.$row->lantai.' ('.$row->nomer.')';
            $tgl  = $row->tanggal_sekarang;
            $id_kamar = $row->id;
        endforeach;

        $data['infokamar'] = $infokamar;
        $data['tanggal'] = $tgl;

        //getHistoryPembayaranByIdKamar($id_kamar)
        $data['pembayaran'] = $this->PembayaranModel->getHistoryPembayaranByIdKamar($id_kamar);

        $totalbayar = 0; $sisa_bayar= 0;
        foreach($data['pembayaran'] as $row):
            $id_pesan = $row->id_pesan;
            $id_kos = $row->id_kos;
            $nama_kos = $row->nama_kos;
            $kmr = $row->kmr;
            $harga_deal = $row->harga_deal;
            $totalbayar =  $totalbayar + $row->besar_bayar;
        endforeach;
        $sisa_bayar= $harga_deal-$totalbayar;

        $data['id_kos'] = $id_kos;
        $data['id_pesan'] = $id_pesan;
        $data['harga_deal'] = rupiah($harga_deal);
        $data['totalbayar'] = rupiah($totalbayar);
        $data['sisa_bayar'] = rupiah($sisa_bayar);
        $data['nokuitansi'] =$_POST['no_kuitansi'];
        //////////////

        //cek dulu apakah sudah ada datanya
        if(isset($_POST['besar_bayar'])){
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                        [
                                'besar_bayar' => 'required'
                        ],
                                [   // Errors
                                    'besar_bayar' => [
                                        'required' => 'Besar pembayaran tidak boleh kosong'
                                    ]
                                ]
                )
            )
            {
                //jika validasi menemukan error
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembayaran/Inputpembayaranpg',[
                        'validation' => $this->validator,
                        'nama_kos' => $data['nama_kos'],
                        'infokamar' => $data['infokamar'],
                        'tanggal' => $data['tanggal'],
                        'id_pesan' => $data['id_pesan'],
                        'harga_deal' => $data['harga_deal'],
                        'totalbayar' => $data['totalbayar'],
                        'sisa_bayar' => $data['sisa_bayar'],
                        'nokuitansi' => $data['nokuitansi']

                    ]);
            }else{
                $data['besar_bayar'] = $_POST['besar_bayar'];
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Pembayaran/Inputpembayaranpg2', $data);
            }   

        }else{
            //tidak perlu dicek
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('Pembayaran/Inputpembayaranpg', $data);
        }
    }

    // proses finishing pembayaran
    public function finishingPembayaranPG(){
        $result = json_decode($_POST['result_data'], true); // array asosiatif
        //var_dump($result);
        //echo $_POST['id_pemesanan'];
        //echo $_POST['id_kos'];
        
        
        //besar bayar dibuat 0 sampai ybs melakukan pembayaran
        $hasil = $this->PembayaranModel->inputDataPembayaranPG($_POST['id_pemesanan'],$this->PembayaranModel->getNoKuitansi($_POST['id_kos']),0);
		$idbayar = $this->PembayaranModel->getIdByrTerakhir($_POST['id_pemesanan']);
        $data = array(
            'id_pembayaran' => $idbayar,
			'order_id' => $result['order_id'],	
			'gross_amount' => $result['gross_amount'],	
			'payment_type' => $result['payment_type'],
			'transaction_time' => $result['transaction_time'],
            'transaction_id' => $result['transaction_id'],
			'bill_key' => "",
			'biller_code' => "",
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code']
		);
        $simpan = $this->PembayaranModel->inputPembayaranPaymentGateway($data);
        if($simpan){
			echo 'sukses';
		}else{
			echo 'gagal';
		}
        return redirect()->to(base_url('pembayaran')); 
        
    }

    // buat token
    public function buatToken($idpesan, $besar_bayar){
        \Midtrans\Config::$serverKey = '<<SERVER_KEY_ANDA>>';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // Required
        $besar_bayar = preg_replace( '/[^0-9 ]/i', '', $besar_bayar);
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $besar_bayar, // no decimal allowed for creditcard
        );
        // Optional
        $hasil = $this->PenghuniModel->getDtPenghuni($idpesan);
        foreach($hasil as $row):
            $nama = $row->nama;
            $telepon  = $row->telepon;
            $email = $row->email;
        endforeach;
        
        // Optional
        $customer_details = array(
            'first_name'    => $nama,
            'last_name'     => "",
            'email'         => $email,
            'phone'         => $telepon
        );
        // Fill transaction details
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );
        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        echo $snapToken;
    }

    // autorefresh pembayaran
    public function autoRefreshPembayaranPG(){
        //query data transaksi yang masih pending	
		$hasil = $this->PembayaranModel->getDataPembayaranUntukAutoRefresh();
        $id = array();
		foreach($hasil as $ks){
			array_push($id,$ks->order_id);
		}
		for($i=0; $i<count($id); $i++){
			$ch = curl_init(); 
			$login = '<<SERVER_KEY_ANDA>>';
			$password = '';
			$orderid = $id[$i];
			$URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
			$output = curl_exec($ch); 
			curl_close($ch);    
			$outputjson = json_decode($output, true);
			if($outputjson['status_code']==200){
				$data = array(
					'status_code' => $outputjson['status_code'],
					'settlement_time' => $outputjson['settlement_time']
				);
			}else{
				$data = array(
					'status_code' => $outputjson['status_code']
				);
			}
            $hasil = $this->PembayaranModel->updateDataPembayaranAutoRefresh($data, $orderid);
			
			/*looping per transaksi*/
		}	
        echo view('Pembayaran/Autorefresh');
		
    }
}