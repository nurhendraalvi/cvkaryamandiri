<?php

namespace App\Models;

use CodeIgniter\Model;


class GrafikPemesananModel extends Model
{
    protected $table = 'pembelian';
    //untuk contoh data grafik line
    public function getDataLine(){
        
        $sql = "
                SELECT  DATE_FORMAT(`tgl_pembelian`,'%M') as Bulan,
                        SUM(jumlah_tanaman) as total
                        
                FROM pembelian GROUP BY DATE_FORMAT(`tgl_pembelian`,'%M') 
                ORDER BY DATE_FORMAT(`tgl_pembelian`,'%m')

        ";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
            foreach($results as $data){
                $hasil[] = $data;
            }
            return $hasil;
    }

    //untuk trend pemesanan
    public function gettrenpemesanan(){
        // cek apakah sudah ada isi dari nilai combo box tahun
        if(isset($_POST['tahun'])){
            $filter_tahun_pemesanan = " WHERE DATE_FORMAT(tgl_pemesanan,'%Y') = ".$_POST['tahun']." ";
            //$filter_tahun_pembayaran= " WHERE DATE_FORMAT(tgl_pembelian,'%Y') = ".$_POST['tahun']." ";
        }else{
            $filter_tahun_pemesanan = "";
            //$filter_tahun_pembayaran = "";
        }
        $sql = "
                        SELECT tbl1.Bulan,
                                ifnull(tbl2.jml_pemesanan,0) as jml_pemesanan
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
                            SELECT DATE_FORMAT(tgl_pemesanan,'%b') as bulan,COUNT(*) as jml_pembelian
                            FROM pembelian ".$filter_tahun_pemesanan."
                            GROUP BY DATE_FORMAT(tgl_pemesanan,'%b') 
                        ) tbl2
                        ON (tbl1.Bulan=tbl2.bulan)		
                        ORDER BY tbl1.bln ASC

                ";
        $query = $this->db->query($sql);
        $results = $query->getResult();  

        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
                //SELECT MONTH( 
    } 

    //method untuk mendapatkan tahun pemesanan maupun pembayaran
    public function getTahunPemesanan()
    {
        $sql = "
                    SELECT DISTINCT(DATE_FORMAT(tgl_pemesanan,'%Y')) as tahun
                    FROM pemesanan
                    

                ";
        $query = $this->db->query($sql);
        $results = $query->getResult();  
        
        foreach($results as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }

    public function getBulanPemesanan($tahun){
        $sql = "SELECT DATE_FORMAT(tgl_pemesanan,'%M') as bulan, DATE_FORMAT(tgl_pemesanan,'%m') as bulan_angka 
                FROM `pemesanan` WHERE YEAR(tgl_pemesanan) = ?
                GROUP BY DATE_FORMAT(tgl_pemesanan,'%M'), DATE_FORMAT(tgl_pemesanan,'%m') ORDER BY 2";
        $dbResult = $this->db->query($sql, array($tahun));

        //dikembalikan dalam bentuk array
        return $dbResult->getResult('array');
    }
    
    public function getLaporanPemesanan($tahun, $bulan){
        $sql = "SELECT a.*
                FROM pemesanan a
                WHERE  year(a.tgl_pemesanan) = ? AND DATE_FORMAT(a.tgl_pemesanan,'%m') = ?";
        $dbResult = $this->db->query($sql, array($tahun, $bulan));
        return $dbResult->getResult();
    }


    // method untuk menampilkan contoh grafik batang
    /*public function getDataGrafikBatang(){
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
    */

}