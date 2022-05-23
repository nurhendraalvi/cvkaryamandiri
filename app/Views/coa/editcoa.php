<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit COA</h1>
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
        foreach($coa as $row):
            $id = $row->id;
            $kode_coa = $row->kode_coa;
            $nama_coa = $row->nama_coa;
          endforeach;

      ?>
        <div class="row">
        <?= form_open('coa/editcoaproses') ?>
        <input type="hidden" id="id" name="id" value="<?= $id?>">
                <div class="mb-3">
                    <label for="kode_coa" class="form-label">Kode COA</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('kode_coa'))>0)
                        {
                          $kode_coa = set_value('kode_coa');
                        }
                    ?>
                    <input type="text" class="form-control" id="kode_coa" name="kode_coa" value="<?= $kode_coa?>" placeholder="Diisi dengan nomer kode COA">
                </div>
                <div class="mb-3">
                    <label for="nama_coa" class="form-label">Nama COA</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('nama_coa'))>0){
                          $kode_coa = set_value('nama_coa');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_coa" name="nama_coa" value="<?= $nama_coa?>" placeholder="Diisi dengan nama COA">
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
