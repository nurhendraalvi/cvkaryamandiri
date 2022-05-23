<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Mainan</h1>
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

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($mainan as $row):
            $id_mainan = $row->id_mainan;
            $nama_vendor = $row->nama_vendor;
            $nama_mainan = $row->nama_mainan;
            $harga_beli = $row->harga_beli;
            $harga_jual = $row->harga_jual;
            $stok_mainan = $row->stok_mainan;
          endforeach;

      ?>
        <div class="row">
        <?= form_open('mainan/editmainanproses') ?>
        <input type="hidden" id="id_mainan" name="id_mainan" value="<?= $id_mainan?>">
        </div>
                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Nama Vendor</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('nama_Vendor'))>0)
                        {
                          $nama_mainan = set_value('nama_vendor');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" 
                    value="<?= $nama_vendor?>" placeholder="Diisi dengan nama_vendor">
                </div>
                <div class="mb-3">
                    <label for="nama_mainan" class="form-label">Nama Mainan</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('nama_mainan'))>0)
                        {
                          $nama_mainan = set_value('nama_mainan');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_mainan" name="nama_mainan" 
                    value="<?= $nama_mainan?>" placeholder="Diisi dengan nama_mainan">
                </div>
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('harga_beli'))>0){
                          $harga_beli = set_value('harga_beli');
                        }
                    ?>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" 
                    value="<?= $harga_beli?>" placeholder="Diisi dengan harga_beli">
                </div>
                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('harga_jual'))>0){
                          $harga_jual = set_value('harga_jual');
                        }
                    ?>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" 
                    value="<?= $harga_jual?>" placeholder="Diisi dengan harga_jual">
                </div>
                <div class="mb-3">
                    <label for="stok_mainan" class="form-label">Stok Mainan</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('stok_mainan'))>0){
                          $harga_jual = set_value('stok_mainan');
                        }
                    ?>
                    <input type="text" class="form-control" id="stok_mainan" name="stok_mainan" 
                    value="<?= $stok_mainan?>" placeholder="Diisi dengan stok mainan">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script 
    src="<?= base_url('js/bootstrap.bundle.min.js') ?>">
    </script>
    <script 
    src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" 
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" 
    crossorigin="anonymous"></script><script 
    src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" 
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" 
    crossorigin="anonymous"></script><script 
    src="<?= base_url('dashboard/dashboard.js') ?>">
    </script>
  
  
  </body>
</html>
