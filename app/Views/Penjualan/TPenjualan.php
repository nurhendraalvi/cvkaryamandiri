<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pembelian </h1>
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
       <div class="row">
             <table class="table table-bordered" id="users-list">
                   <thead>
                    <tr>
                         <td align="right">Tanggal Transaksi</td>
                         <td colspan="3"><?php echo date("Y/m/d") ?>
                             <input type="hidden" name="date" id="date" value="<?php echo date("Y/m/d") ?>">
                         </td>
                      </tr>
                      <tr>
                          <td align="right">Waktu Transaksi</td>
                          <td colspan="3"><?php
                                date_default_timezone_set("Asia/Jakarta");
                                echo date("h:i:sa");
                                ?>
                                <input type="hidden" name="timeset" id="timeset" value="<?php
                                date_default_timezone_set("Asia/Jakarta");
                                echo date("h:i:sa");
                                ?>">
                                </td>
                      </tr>
                      <tr>
                         <th>Nama Mainan</th>
                         <th>Harga</th>
                         <th>Quantity</th>
                         <th>Total</th>
                         <th>Aksi</th>
                      </tr>
                   </thead>
                   <tbody>
                    
                        <?php //$total_sum=0; 
                        $total = 0;
                        $subtotal = 0;
                        foreach($dummy as $row){ 
                            $total = $row->harga * $row->quantity;
                            $subtotal = $subtotal + $total;
                        ?>
                     <tr>
                         <td><?php echo $row->nama_mainan; ?></td>
                         <td><?php echo $row->harga; ?></td> 
                         <td><?php echo $row->quantity; ?></td>
                         <td><?php echo $total; ?></td> 
                      </tr>
                     <?php } ?>
                           
                    </tbody>
                 </table >
                 <form action="<?php echo base_url('CPenjualan/InsertTransaksi'); ?>" method="POST">
                     <table class="table table">
                         <tr>
                             <td>Total Belanja</td>
                             <td>:</td>
                             <td><input type="number" class="form-control" id="subtot" name="subtot" value="<?php echo $subtotal; set_value('subtot')?>" onkeyup="sum();"></td>
                         </tr>
                         <tr>
                             <td>Bayar</td>
                             <td>:</td>
                             <td><input type="number" class="form-control" id="bayar" name="bayar" placeholder="Masukkan nominal uang" value="<?= set_value('bayar') ?>" onkeyup="sum();"></td>
                         </tr>
                         <tr>
                             <td>Kembali</td>
                             <td>:</td>
                             <td><input type="number" class="form-control" id="kembali" name="kembali" value="<?= set_value('kembali') ?>" onkeyup="sum();" placeholder="Uang Kembali"></td>
                         </tr>
                         <tr>
                             <td colspan="3" align="right"><button type="submit" class="btn btn-primary">Beli</button></td>
                         </tr>
                     </table>
                 </form>
                </div>
            
        </div>
        <script>
        function sum() {
                   var txtFirstNumberValue = document.getElementById('bayar').value;
                   var txtSecondNumberValue = document.getElementById('subtot').value;
                   var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
                   if (!isNaN(result)) {
                       document.getElementById('kembali').value = result;
                   }
               }
        </script>
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