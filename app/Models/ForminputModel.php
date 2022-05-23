<?php

namespace App\Models;

use CodeIgniter\Model;

class ForminputModel extends Model
{
    protected $table = 'form_input';

    //method untuk input data
    //dokumen dan gambar menjadi paramter inputan karena namanya sudah diganti
    public function insertData($dok, $gbr){
        $tanggal = $_POST['tanggal'];
        $gender = $_POST['gender'];
        $hobi = $_POST['hobi'];

        $tgl = substr($_POST['waktu'],0,10); //mengembalikan 2021-02-2817:14
        $wkt = substr($_POST['waktu'],11); //mengembalikan  17:44
        $tgl_wkt = $tgl."-".$wkt.":00"; //mengembalikan 2021-02-28 17:44

        $hasil = $this->db->query("INSERT INTO form_input SET tanggal = ?, waktu=?, jenis=?, gambar=? , dokumen=?", array($tanggal, $tgl_wkt, $gender, $gbr, $dok));
        
        //dapatkan id autoincrement dulu
        $dbResult = $this->db->query("SELECT MAX(id) as id_mak FROM form_input");
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row)
        {
            $id_mak = $row->id_mak;
        }

        //karena hoby bisa banyak maka dilooping
        for($i=0;$i<count($hobi);$i++){
            //input ke tabel detail
            $hasil = $this->db->query("INSERT INTO form_input_detail SET id = ?, hobi=?", array($id_mak, $hobi[$i]));
        }

        return $hasil;
        
    }

    //mendapatkan data
    public function getData(){
        $sql = "SELECT a.*, 
                (SELECT group_concat(hobi separator '<br>') FROM form_input_detail b WHERE a.id=b.id) as list_hobi 
                FROM form_input a";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();
    }

    //mendapatkan data form input berdasarkan id untuk proses edit data
    public function getDataById($id){
        $sql = "SELECT * FROM form_input WHERE id = ?";
        $dbResult = $this->db->query($sql, array($id));
        return $dbResult->getResult();
    }

    //mendapatkan data form input detail berdasarkan id untuk proses edit data
    public function getDataDetailById($id){
        $sql = "SELECT * FROM form_input_detail WHERE id = ?";
        $dbResult = $this->db->query($sql, array($id));
        return $dbResult->getResult();
    }

    //menghapus data
    public function deleteData($id){
        //dapatkan data nama file berdasarkan id file
        $dbResult = $this->db->query("SELECT gambar,dokumen FROM form_input WHERE id = ?", array($id));
        $hasil = $dbResult->getResult();
        foreach ($hasil as $row)
        {
            $nama_file_gambar = $row->gambar;
            $nama_file_dokumen = $row->dokumen;
        }

        //delete file di server
        if(is_file(FCPATH.'dokumen/upload/'.$nama_file_dokumen)){
            unlink(FCPATH.'dokumen/upload/'.$nama_file_dokumen); //delete file dokumen
        }
        if(is_file(FCPATH.'dokumen/upload/'.$nama_file_gambar)){
            unlink(FCPATH.'dokumen/upload/'.$nama_file_gambar); //delete file gambar
        }
        

        //hapus tabel induknya
        $hasil = $this->db->query("DELETE FROM form_input WHERE id = ?", array($id));

        //hapus tabel anaknya
        $hasil = $this->db->query("DELETE FROM form_input_detail WHERE id = ?", array($id));

        
    }

    //update data
    public function updateData($dok, $gbr){
        $tanggal = $_POST['tanggal'];
        $gender = $_POST['gender'];
        $hobi = $_POST['hobi'];

        $tgl = substr($_POST['waktu'],0,10); //mengembalikan 2021-02-28
        $wkt = substr($_POST['waktu'],11); //mengembalikan  17:44
        $tgl_wkt = $tgl."-".$wkt.":00"; //mengembalikan 2021-02-28 17:44

        $hasil = $this->db->query("UPDATE form_input SET tanggal = ?, waktu=?, jenis=?, gambar=? , dokumen=? WHERE id=?", array($tanggal, $tgl_wkt, $gender, $gbr, $dok, $_POST['id']));

        //delete dulu ditabel anak, baru dimasukkan lagi
        $hasil = $this->db->query("DELETE FROM form_input_detail WHERE id=?", array($_POST['id']));


        //karena hoby bisa banyak maka dilooping
        for($i=0;$i<count($hobi);$i++){
            //input ke tabel detail
            $hasil = $this->db->query("INSERT INTO form_input_detail SET id = ?, hobi=?", array($_POST['id'], $hobi[$i]));
        }

        return $hasil;
    }    
}