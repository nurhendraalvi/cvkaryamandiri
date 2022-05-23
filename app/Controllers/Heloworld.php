<?php
namespace App\Controllers;

use App\Models\KosanModel;
use App\Models\ForminputModel;
use App\Models\PembayaranModel;
use App\Models\PemodalanModel;
use App\Models\CoaModel;
use App\Models\GrafikModel;

//tambahan untuk phpspreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Heloworld extends BaseController
{
	public function __construct()
    {
        //load kelas AkunModel
        $this->kosanmodel = new KosanModel();

        //load kelas form input model
        $this->ForminputModel = new ForminputModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->CoaModel = new CoaModel();
        $this->GrafikModel = new GrafikModel();
        $this->PemodalanModel = new PemodalanModel();
        //helper('rupiah');
        session_start();
    }

    // tes parsing berita dari newsapi
    public function tesApiNewsAPI(){
        $json = file_get_contents('https://newsapi.org/v2/everything?q=ramadhan&language=id&apiKey=60efcf9a1980433f947fa088ed14c85a'); 
        $hasil = json_decode($json);
        
        if($hasil->status=="ok"){
            echo "Jumlah Status     : ".$hasil->status."<br>";
            echo "Jumlah Results    : ".$hasil->totalResults."<br>";
            echo "Sumber Artikel-1  : ".$hasil->articles[0]->source->name."<br>";
            echo "Nama Artikel-2    : ".$hasil->articles[1]->title."<br>";
            echo "URL Gambar        : ".$hasil->articles[1]->urlToImage."<br>";

            // dapatkan jumlah datanya
            echo "<hr>";
            foreach ($hasil->articles as $row){
                echo $row->source->name."-".$row->author."-".$row->title."-".$row->url."-".$row->description."-".$row->urlToImage;
                echo "<br>"; 
            } 
               
        }
        
    }
}
