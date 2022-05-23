<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Mainan</h1>
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
        if(isset($validation))
        {
          echo $validation->listErrors();
        } 
      ?>
        <div class="row">
        
        <div class="mb-3">
            <form action="<?php echo base_url().'/mainan/inputmainan/'?>" method="POST">
                    <label for="nama_vendor" class="form-label">Nama Vendor</label>
                    
                    <select name="nama_vendor" class="form-control">
                        <?php
                        //form_open('mainan/inputmainan') 
                        foreach ($vendor as $dataItem) {
                                $id = $dataItem->nama_vendor;
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $id; ?></option>
                        <?php }?>
                    </select>
                    
                    <!--<input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?= set_value('nama_vendor')?>" placeholder="Diisi dengan nama_mainan">-->
                </div>
                <div class="mb-3">
                    <label for="nama_mainan" class="form-label">Nama Mainan</label>
                    <input type="text" class="form-control" id="nama_mainan" name="nama_mainan" value="<?= set_value('nama_mainan')?>" placeholder="Diisi dengan nama_mainan">
                </div>
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= set_value('harga_beli')?>" placeholder="Diisi dengan harga_beli">
                </div>
                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= set_value('harga_jual')?>" placeholder="Diisi dengan harga_jual">
                </div>
                <div class="mb-3">
                    <label for="stok_mainan" class="form-label">Stok Mainan</label>
                    <input type="text" class="form-control" id="stok_mainan" name="stok_mainan" value="<?= set_value('stok_mainan')?>" placeholder="Diisi dengan Stok Mainan">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
