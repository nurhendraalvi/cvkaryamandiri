<?php

namespace App\Models;

use CodeIgniter\Model;

class GrafikModel extends Model
{

    //untuk contoh data grafik line
    public function getDataLine(){
        $sql = "
                SELECT  DATE_FORMAT(`OrderDate`,'%M') as Bulan,
                        SUM(TotalRevenue) as total,
                        SUM(TotalProfit) as total_profit 
                FROM kosan.penjualan GROUP BY DATE_FORMAT(`OrderDate`,'%M') 
                ORDER BY DATE_FORMAT(`OrderDate`,'%m')

        ";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
            foreach($results as $data){
                $hasil[] = $data;
            }
            return $hasil;
    }

    public function getTrenPemesanan()
    {
        return $this->db->query("SELECT YEAR(tgl_pemesanan) as tahun, MONTHNAME(tgl_pemesanan) as tgl_pemesanan, SUM(total_pemesanan) as total_pemesanan, SUM(total_bayar) as total_bayar FROM pemesanan group by MONTHNAME(tgl_pemesanan), YEAR(tgl_pemesanan)")->getResult();
    }
    //untuk trend pemesanan
    /*public function getTrenPemesanan(){
        // cek apakah sudah ada isi dari nilai combo box tahun
        if(isset($_POST['tahun'])){
            $filter_tahun_pemesanan = " WHERE DATE_FORMAT(tgl_pesan,'%Y') = ".$_POST['tahun']." ";
            $filter_tahun_pembayaran= " WHERE DATE_FORMAT(tgl_bayar,'%Y') = ".$_POST['tahun']." ";
        }else{
            $filter_tahun_pemesanan = "";
            $filter_tahun_pembayaran = "";
        }
        $sql = "
                        SELECT tbl1.Bulan,
                                ifnull(tbl2.jml_pesanan,0) as jml_pesanan,
                                ifnull(tbl3.jml_pembayaran,0) as jml_pembayaran
                        FROM
                        (
                            SELECT 'Jan' as Bulan, 1 as bln
                            UNION
                            SELECT 'Feb' as Bulan, 2 as bln
                            UNION
                            SELECT 'Mar' as Bulan, 3 as bln
                            UNION
                            SELECT 'Apr' as Bulan, 4 as bln
                            UNION
                            SELECT 'May' as Bulan, 5 as bln
                            UNION
                            SELECT 'Jun' as Bulan, 6 as bln
                            UNION
                            SELECT 'Jul' as Bulan, 7 as bln
                            UNION
                            SELECT 'Aug' as Bulan, 8 as bln
                            UNION
                            SELECT 'Sep' as Bulan, 9 as bln
                            UNION
                            SELECT 'Oct' as Bulan, 10 as bln
                            UNION
                            SELECT 'Nov' as Bulan, 11 as bln
                            UNION
                            SELECT 'Dec' as Bulan, 12 as bln
                        ) tbl1
                        LEFT OUTER JOIN
                        (
                            SELECT DATE_FORMAT(tgl_pesan,'%b') as bulan,COUNT(*) as jml_pesanan
                            FROM pemesanan ".$filter_tahun_pemesanan."
                            GROUP BY DATE_FORMAT(tgl_pesan,'%b') 
                        ) tbl2
                        ON (tbl1.Bulan=tbl2.bulan)
                        LEFT OUTER JOIN
                        (
                            SELECT DATE_FORMAT(tgl_bayar,'%b') as bulan,COUNT(DISTINCT(id_pemesanan)) as jml_pembayaran
                            FROM pembayaran ".$filter_tahun_pembayaran."
                            GROUP BY DATE_FORMAT(tgl_bayar,'%b') 
                        ) tbl3
                        ON(tbl1.bulan=tbl3.bulan) 		
                        ORDER BY tbl1.bln ASC

                ";
        $query = $this->db->query($sql);
        $results = $query->getResult();  

        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }*/

    //method untuk mendapatkan tahun pemesanan maupun pembayaran
    public function getTahunPemesananPembayaran()
    {
        $sql = "
                    SELECT DISTINCT(DATE_FORMAT(tgl_pesan,'%Y')) as tahun
                    FROM pemesanan 
                    UNION
                    SELECT DISTINCT(DATE_FORMAT(tgl_bayar,'%Y')) as tahun
                    FROM pembayaran
                    UNION
                    SELECT '2020'
                    ORDER BY 1

                ";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }

    //method untuk mendapatkan okupansi kamar dalam bentuk pie chart
    public function getOkupansiKamar(){
        //$id_kos = $_POST['id_kos'];
        if(isset($_POST['id_kos'])){
            $id_kos = $_POST['id_kos'];
        }else{
            $id_kos = 6;
        }
        
        $sql = "
                SELECT  status, COUNT(id) as TotalKamar,
                        CONCAT('rgba(',ROUND(RAND()*(254)),',',ROUND(RAND()*(254)),',',ROUND(RAND()*(254)),',',1,')') as warna
                FROM kamar
                WHERE id_kos = ?
                GROUP BY status
            ";
        $query = $this->db->query($sql, array($id_kos));
        $results = $query->getResult();  
        
        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }

    // method untuk menampilkan contoh grafik batang
    public function getDataGrafikBatang(){
        $sql = "SELECT tbl2.Hari,ifnull(tbl1.penj,0) as totalpenjualan,
                                 ifnull(tbl1.biaya,0) as totalbiaya,
                                 ifnull(tbl1.pendapatan,0) as totalpendapatan
        FROM 
        (
            SELECT DATE_FORMAT(orderdate,'%a') as Hari,
                    round(sum(TotalRevenue),0) as penj,
                    round(sum(TotalCost),0) as biaya,
                    round(sum(TotalProfit),0) as pendapatan
            FROM visualisasi.penjualan 
            GROUP BY DATE_FORMAT(orderdate,'%a')
        ) tbl1
        RIGHT OUTER JOIN 
        (
            SELECT 'Mon' as Hari, 1 as tgl
            UNION
            SELECT 'Tue' as Hari, 2 as tgl
            UNION
            SELECT 'Wed' as Hari, 3 as tgl
            UNION
            SELECT 'Thu' as Hari, 4 as tgl
            UNION
            SELECT 'Fri' as Hari, 5 as tgl
            UNION
            SELECT 'Sat' as Hari, 6 as tgl
            UNION
            SELECT 'Sun' as Hari, 7 as tgl
        ) tbl2
        ON (tbl1.Hari=tbl2.Hari)";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
            foreach($results as $data){
                $hasil[] = $data;
            }
            return $hasil;
        
    }

    // grafik pie
    public function getDataGrafikPie(){
        $sql = "SELECT Region,ROUND(SUM(TotalProfit)) as TotalPendapatan,
                        CONCAT('rgba(',ROUND(RAND()*(254)),',',ROUND(RAND()*(254)),',',ROUND(RAND()*(254)),',',1,')') as warna
                 FROM visualisasi.penjualan
                 GROUP BY Region";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
            foreach($results as $data){
                $hasil[] = $data;
            }
            return $hasil;
    }

}