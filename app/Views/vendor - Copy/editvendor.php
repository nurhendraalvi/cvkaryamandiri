<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Vendor</h1>
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
        foreach($vendor as $row):
            $id_vendor = $row->id_vendor;
            $nama_vendor = $row->nama_vendor;
            $alamat_vendor = $row->alamat_vendor;
            $no_telp_vendor = $row->no_telp_vendor;
          endforeach;

      ?>
        <div class="row">
        <?= form_open('vendor/editvendorproses') ?>
        <input type="hidden" id="id_vendor" name="id_vendor" value="<?= $id_vendor?>">
                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Nama vendor</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('nama_vendor'))>0)
                        {
                          $nama_vendor = set_value('nama_vendor');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" 
                    value="<?= $nama_vendor?>" placeholder="Diisi dengan nomer nama_vendor">
                </div>
                <div class="mb-3">
                    <label for="alamat_vendor" class="form-label">Alamat vendor</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('alamat_vendor'))>0){
                          $alamat_vendor = set_value('alamat_vendor');
                        }
                    ?>
                    <input type="text" class="form-control" id="alamat_vendor" name="alamat_vendor" 
                    value="<?= $alamat_vendor?>" placeholder="Diisi dengan alamat_vendor">
                </div>
                <div class="mb-3">
                    <label for="no_telp_vendor" class="form-label">Telepon vendor</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('no_telp_vendor'))>0){
                          $no_telp_vendor = set_value('no_telp_vendor');
                        }
                    ?>
                    <input type="text" class="form-control" id="no_telp_vendor" name="no_telp_vendor" 
                    value="<?= $no_telp_vendor?>" placeholder="Diisi dengan no_telp_vendor">
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
