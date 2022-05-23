<?php

namespace App\Models;

use CodeIgniter\Model;

class PembebananModel extends Model
{
    protected $table = 'pembebanan';

    //untuk mendapatkan data kode beban
    public function getBebanData(){
        $dbResult = $this->db->query("SELECT * FROM coa WHERE kode_coa LIKE '5%' AND length(kode_coa)>1");
        return $dbResult->getResult();
    }

    //untuk mendapatkan data list beban
    public function getListBeban(){
        if(isset($_SESSION['daftarkosan'])){
            $sql =  "
                        SELECT *
                        FROM pembebanan
                        WHERE id_kos IN (".$_SESSION['daftarkosan'].")
                    ";
            return $this->db->query($sql)->getResult();
        }else{
            $dbResult = $this->db->query("SELECT * FROM pembebanan");
            return $dbResult->getResult();
        }

        
    }

    //untuk menginputkan pembebanan dan penjurnalan
    public function inputBeban(){
        $id_kos = $_POST['namakos'];
        $kodebeban = $_POST['kodebeban'];
        $nama = $_POST['nama'];
        $biaya = $_POST['biaya']; 
        $waktu = $_POST['waktu'];
        
        //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        $biaya = preg_replace( '/[^0-9 ]/i', '', $biaya);

        //dapatkan id transaksi untuk pembebanan
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }
        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru modal yang dimasukkan

        //masukkan ke pemesanan
        $sql = "INSERT INTO pembebanan SET id_transaksi = ?, biaya=?, nama=?, waktu=?, 
                            id_kos = ?
                ";
        $hasil = $this->db->query($sql, array($id_transaksi, $biaya, $nama, $waktu, $id_kos));

         //pencatatan jurnal pada saat pembayaran beban menggunakan metode hard code
         $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                     SET id_transaksi = ?, kode_akun = ?, tgl_jurnal=?, posisi_d_c = 'd', nominal=?,
                     kelompok = 1, transaksi='pembebanan'
                ";
         $hasil = $this->db->query($sql, array($id_transaksi, $kodebeban, $waktu, $biaya));

         $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                     SET id_transaksi = ?, kode_akun = '111', tgl_jurnal=?, posisi_d_c = 'c', nominal=?,
                     kelompok = 1, transaksi='pembebanan'
                ";
         $hasil = $this->db->query($sql, array($id_transaksi, $waktu, $biaya));

        return $hasil;
    }
}