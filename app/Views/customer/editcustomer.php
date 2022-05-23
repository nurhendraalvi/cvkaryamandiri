<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Customer</h1>
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
        foreach($customer as $row):
            $id_customer = $row->id_customer;
            $nama_customer = $row->nama_customer;
            $alamat_customer = $row->alamat_customer;
            $telepon_customer = $row->telepon_customer;
          endforeach;

      ?>
        <div class="row">
        <?= form_open('customer/editcustomerproses') ?>
        <input type="hidden" id="id_customer" name="id_customer" value="<?= $id_customer?>">
                <div class="mb-3">
                    <label for="nama_customer" class="form-label">Nama Customer</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('nama_customer'))>0)
                        {
                          $nama_customer = set_value('nama_customer');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" 
                    value="<?= $nama_customer?>" placeholder="Diisi dengan nomer nama_customer">
                </div>
                <div class="mb-3">
                    <label for="alamat_customer" class="form-label">Alamat Customer</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('alamat_customer'))>0){
                          $alamat_customer = set_value('alamat_customer');
                        }
                    ?>
                    <input type="text" class="form-control" id="alamat_customer" name="alamat_customer" 
                    value="<?= $alamat_customer?>" placeholder="Diisi dengan alamat_customer">
                </div>
                <div class="mb-3">
                    <label for="telepon_customer" class="form-label">Telepon Customer</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('telepon_customer'))>0){
                          $telepon_customer = set_value('telepon_customer');
                        }
                    ?>
                    <input type="text" class="form-control" id="telepon_customer" name="telepon_customer" 
                    value="<?= $telepon_customer?>" placeholder="Diisi dengan telepon_customer">
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
