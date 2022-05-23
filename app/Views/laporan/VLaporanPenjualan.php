<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pilih Laporan Tahunan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
 
    <?php
    if (isset($validation)) {
        echo $validation->listErrors();
    }
    ?>
         <center>
             <div class="row">
             <table align="center"><tr><td>
                <form action="<?php echo base_url('Laporanpemesanan/LaporanPenjualan2'); ?>" method="POST">
                    <table>
                        <tr>
                            <td>
                                <select name="data" id="inputState" class="form-control">
                                                
                                    <?php 
                                        foreach ($year as $key) {
                                            echo "<option value='$key->tahun'>".$key->tahun."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block">
                            </td>
                        </tr>
                    </table>
                </form>
            </td></tr></table>
         </div>
         </center>

         <?php 
            /*if (isset($_POST['submit'])) {

                $year = $_POST['data'];
                $data2 = $this->db->query("SELECT monthname(tanggal) as bulan, count(tanggal) as tot_penjualan, sum(harga) as penjualan FROM `t_penjualan` where year(tanggal) = '$year' group by monthname(tanggal)"); //buat CI 4 query tidak bisa di eksekusi di view
                return $data2->getResult();*/
            ?>
        <div class="row">
         <div class="mt-3">
     <table class="table table-bordered" id="users-list">
       <thead>
          <tr>
             <th>Bulan</th>
             <th>Total Transaksi</th>
             <th>Total Penjualan (RP)</th>
             <th>Aksi</th>
          </tr>
       </thead>
       <tbody>
          <?php foreach($data2 as $key){ ?>
          <tr>
             <td><?php echo $key->bulan; ?></td>
             <td><?php echo $key->tot_penjualan; ?></td>
             <td><?php echo $key->penjualan; ?></td>
             <td>
              <a href="<?php echo base_url('Laporanpemesanan/MonthReport/'.$key->bulan);?>" class="btn btn-primary btn-sm">Detail</a>
              </td>
          </tr>
         <?php } ?>
       </tbody>
   <?php //} ?>
     </table>
  </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
              $('#users-list').DataTable();
          } );
        </script>      

     </div>
            
      <!--</form>-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
              $('#users-list').DataTable();
          } );
        </script>      

     </div>

</main>
</div>
</div>

<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
</body>

</html>