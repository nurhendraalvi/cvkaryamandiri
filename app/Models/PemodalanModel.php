<?php

namespace App\Models;

use CodeIgniter\Model;

class PemodalanModel extends Model
{
    protected $table = 'pemodalan';

    public function getAll(){
        if(isset($_SESSION['daftarkosan'])){
            $sql =  "
                        SELECT *
                        FROM pemodalan
                        WHERE id_kos IN (".$_SESSION['daftarkosan'].")
                    ";
            return $this->db->query($sql)->getResult();
        }else{
            $dbResult = $this->db->query("SELECT * FROM pemodalan");
            return $dbResult->getResult();
        }

    }

    //untuk memasukkan data modal
    public function setorModal(){

        //mendapaatkan id_transaksi terakhir dari seluruh transaksi
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }

        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru modal yang dimasukkan
        $besar = preg_replace( '/[^0-9 ]/i', '', $_POST['besar']);//dihilangkan karakter maskingnya karena pakai masking
        $nama = $_POST['nama'];
        $waktu = $_POST['waktu'];
        $idkos = $_POST['idkosan'];
        $hasil = $this->db->query("INSERT INTO pemodalan SET id_transaksi = ?, besar=?, nama=?, waktu=?, id_kos=? ", array($id_transaksi, $besar, $nama, $waktu, $idkos));
        
        //masukkan ke jurnal
        $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    SELECT a.id_transaksi, b.kode_akun,a.waktu,b.posisi,a.besar,b.kelompok,b.transaksi
                    FROM pemodalan a
                    CROSS JOIN transaksi_coa b
                    WHERE a.id_transaksi = ? AND b.transaksi = 'pemodalan' AND b.kelompok = 1
            ";
        $hasil = $this->db->query($sql, array($id_transaksi));


        return $hasil;
    }

    //untuk memasukkan data modal
    public function tarikModal(){

        //mendapaatkan id_transaksi terakhir dari seluruh transaksi
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }

        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru modal yang dimasukkan
        $besar = preg_replace( '/[^0-9 ]/i', '', $_POST['besar']);//dihilangkan karakter maskingnya karena pakai masking
        $nama = $_POST['nama'];
        $waktu = $_POST['waktu'];
        $hasil = $this->db->query("INSERT INTO pemodalan SET id_transaksi = ?, besar=?, nama=?, waktu=? ", array($id_transaksi, $besar, $nama, $waktu));
        
        //masukkan ke jurnal
        $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    SELECT a.id_transaksi, b.kode_akun,a.waktu,b.posisi,a.besar,b.kelompok,b.transaksi
                    FROM pemodalan a
                    CROSS JOIN transaksi_coa b
                    WHERE a.id_transaksi = ? AND b.transaksi = 'pemodalan' AND b.kelompok = 2
            ";
        $hasil = $this->db->query($sql, array($id_transaksi));


        return $hasil;
    }

    //delete modal
    public function deleteModal($id_transaksi){
        $hasil = $this->db->query("DELETE FROM pemodalan WHERE id_transaksi =? ", array($id_transaksi));
        $hasil = $this->db->query("DELETE FROM jurnal WHERE id_transaksi =? ", array($id_transaksi));
        return $hasil;
    }

    //query kosan yang ada modalnya
    public function getKosanModal(){
        $sql = "
                    SELECT a.id_kos,a.nama
                    FROM kos a
                    JOIN pemodalan b ON (a.id_kos=b.id_kos)
                    GROUP BY a.id_kos,a.nama
                    ORDER BY 2 ASC
                ";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();
    }

    //cek apakah modal yang ditarik lebih besar dari moda ayg ada di database atau tidak
    public function cekTarikModal($idkos, $besar){
        $besar = preg_replace( '/[^0-9 ]/i', '', $besar);
        //dapatkan jumlah modal untuk id kos - $idkos
        $sql = "
                    SELECT SUM(besar) as besar
                    FROM pemodalan 
                    WHERE id_kos = ?
                ";
        $dbResult = $this->db->query($sql, array($idkos));
        foreach($dbResult->getResult() as $row):
            $besar_modal = $row->besar;
        endforeach;

        //dapatkan jumlah modal untuk id kos - $idkos
        $sql = "
                    SELECT SUM(nominal) as besar
                    FROM jurnal a
                    JOIN pemodalan b ON (a.id_transaksi=b.id_transaksi)
                    WHERE b.id_kos = ? AND a.transaksi = 'pemodalan' AND a.kelompok='2' AND a.kode_akun = '32'
                ";
        $dbResult = $this->db->query($sql, array($idkos));
        foreach($dbResult->getResult() as $row):
            $besar_penarikan = $row->besar;
        endforeach;

        //cek apakah jumlah penarikan lebih besar dari jumlah modal dikurangi jumlah penarikan sebelumnya
        //echo number_format($besar)."-".number_format($besar_modal)."-".number_format($besar_penarikan);
        //echo "<br>";
        if($besar>=($besar_modal-$besar_penarikan)){
            return 0; //kembalikan 0 jika besar penarikan masih lebih besar atau sama dengan sisa modal
        }else{
            return 1; //kembalikan 1 jika besar penarikan masih kurang dari sisa modal
        }
        
        
    }

}