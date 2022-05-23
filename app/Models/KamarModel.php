<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table = 'barang';

    //seluruh data kamar
    public function getAll(){
        return $this->findAll();
    }

    //dapatkan data seluruh kamarberdasarkan id kos tertentu
    public function getKamar($id){
        /*
        $dbResult = $this->db->query("SELECT * FROM kamar WHERE id_kos = ? ORDER BY lantai, nomer", array($id));
        return $dbResult->getResult();
        */
        $sql = "SELECT a.*,ifnull(b.tgl_selesai,'-') as tgl_selesai,ifnull(c.nama,'-') as nama
                FROM barang a
                LEFT OUTER JOIN 
                (SELECT * FROM pemesanan WHERE status_barang = 'Isi') b
                ON (a.id=b.id_barang)
                LEFT OUTER JOIN penghuni c
                ON (b.id_penghuni=c.id)
                WHERE id_kos = ?
                ORDER BY a.lantai, a.nomer
                ";

        $dbResult = $this->db->query($sql, array($id));
        $hasil = $dbResult->getResult();        
        return $hasil;
    }

    //dapatkan data kamar berdasarkan id kamar
    public function getKamarByIdKamar($id){
        $dbResult = $this->db->query("SELECT * FROM barang WHERE id = ?", array($id));
        return $dbResult->getResult();
    }

    //untuk memasukkan data kamar
    public function insertData(){
        $id_kos = $_POST['id_kos'];
        $nomer = $_POST['nomer'];
        $lantai = $_POST['lantai'];

        //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        $harga = preg_replace( '/[^0-9 ]/i', '', $_POST['harga']);

        //$harga = $_POST['harga'];
        $hasil = $this->db->query("INSERT INTO barang SET id_customer = ?, jenis_barang=?, berat=?, harga=?, `status`='Kosong'", array($id_customer, $jb, $berat, $harga));
        return $hasil;
    }

    //untuk mendapatkan data kos sesuai dengan ID untuk diedit
    public function updateData(){
        $id = $_POST['id_barang'];
        $id_customer = $_POST['id_customer'];
        $jb = $_POST['jenis_barang'];
        $berat = $_POST['berat'];

        //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        $harga = preg_replace( '/[^0-9 ]/i', '', $_POST['harga']);

        //$harga = $_POST['harga'];
        $hasil = $this->db->query("UPDATE barang SET jenis_barang = ?, berat=?, harga=? WHERE id_barang =? ", array($jb, $berat, $harga, $id_customer));
        return $hasil;
    }
}