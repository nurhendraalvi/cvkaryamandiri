<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pilih Pembelian </h1>
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
         <div class="mt-3">
     <table class="table table-bordered" id="users-list">
       <thead>
          <tr>
             <th>Nama Vendor</th>
             <th>Mainan</th>
             <th>Harga Beli</th>
             <th>Order</th>
          </tr>
       </thead>
       <tbody>
          <?php foreach($pembelian as $data){ ?>
          <tr>
             <td><?php echo $data->nama_vendor; ?></td>
             <td><?php echo $data->nama_mainan; ?></td>
             <td><?php echo $data->harga_beli; ?></td>
             <td>
              <a href="<?php echo base_url('Pembelian/SellForm/'.$data->id_mainan);?>" class="btn btn-primary btn-sm">Pesan</a>
              </td>
          </tr>
         <?php } ?>
       </tbody>
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
    <!---
    <div class="row">
        <?= form_open('Pembelian/inputdata') ?>
        
        <div class="mb-3">
            <label for="nama_vendor" class="form-label">Nama Vendor</label>
            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?= set_value('nama_vendor') ?>" placeholder="Diisi dengan nama vendor">
        </div>
        <div class="mb-3">
            <label for="nama_mainan" class="form-label">Nama Mainan</label>
            <input type="text" class="form-control" id="nama_mainan" name="nama_mainan" value="<?= set_value('nama_mainan') ?>" placeholder="Diisi dengan nama vendor">
        </div>
        <div class="mb-3">
            <label for="jumlah_mainan" class="form-label">Jumlah Mainan</label>
            <input type="text" class="form-control" id="jumlah_mainan" name="jumlah_mainan" value="<?= set_value('jumlah_mainan') ?>" placeholder="Diisi dengan jumlah mainan">
        </div>
        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="text" class="form-control" id="Harga Beli" name="harga_beli" value="<?= set_value('harga_beli') ?>" placeholder="Diisi dengan harga_beli">
        </div>
        <div class="mb-3">
            <label for="total_pembelian" class="form-label">Total Pembelian</label>
            <input type="text" class="form-control" id="total_pembelian" name="total_pembelian" value="<?= set_value('total_pembelian') ?>" placeholder="Diisi dengan pembelian">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> -->


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