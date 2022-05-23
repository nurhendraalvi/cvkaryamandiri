<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun';

    public function cekUsernamePwd(){
        //bind variabel untuk mencegah sql injection
        $nama = $_POST['inputUsername'];
        $sandi = $_POST['inputPassword'];
        $dbResult = $this->db->query("SELECT COUNT(*) as jml FROM akun WHERE username = ? AND pwd = ?", array($nama, md5($sandi)));
        return $dbResult->getResult();
    }

    // untuk mendapatkan kelompok user
    public function getGroupUser(){
        $nama = $_POST['inputUsername'];
        $dbResult = $this->db->query("SELECT user_group FROM akun WHERE username = ?", array($nama));
        return $dbResult->getResult();
    }

    // untuk mendapatkan list id kosan dari suatu pemilik
    public function getListKosan(){
        $nama = $_POST['inputUsername'];
        $dbResult = $this->db->query("SELECT GROUP_CONCAT(id_kos) as daftarkosan FROM pemilik_kos WHERE username = ?", array($nama));
        return $dbResult->getResult();
    }
    

    //untuk update last login ketika berhasil login
    public function updatelastlogin(){
        $nama = $_POST['inputUsername'];
        $hasil = $this->db->query("UPDATE akun SET last_login = now() WHERE username = ?", array($nama));
        return $hasil;
    }

    //untuk mendapatkan last login
    public function getlastlogin($nama){
        $dbResult = $this->db->query("SELECT last_login FROM akun WHERE username = ? ", array($nama));
        return $dbResult->getResult();
        
    }
}