<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Kosan</h1>
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
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($koskosan as $row):
          $id = $row->id_kos;
          $nama = $row->nama;
          $jenis_kos = $row->jenis_kos;
          $alamat = $row->alamat;
          $telepon = $row->telepon;
        endforeach;
      ?>
        <div class="row">
        <?= form_open('kosan/editkosanproses') ?>
            
            <input type="hidden" id="id_kos" name="id_kos" value="<?= $id?>">
                <div class="mb-3">
                    <label for="namakosan" class="form-label">Nama Kosan</label>
                    <?php
                        //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                        if(strlen(set_value('namakosan'))>0){
                          $nama = set_value('namakosan');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="namakosan" name="namakosan" value="<?= $nama?>" placeholder="Diisi dengan nama kos">
                </div>
                <div class="mb-3">
                <label for="jeniskosan" class="form-label">Jenis Kos</label>
                    <select class="form-select" aria-label="Default select example" name="jeniskosan">
                        <?php
                            //jika set value jeniskosan tidak kosong maka isi $jenis_kos diganti dengan isian dari user
                            if(strlen(set_value('jeniskosan'))>0){
                              $jenis_kos = set_value('jeniskosan');
                            }
                              echo set_value('jenis_kos');
                            $lk=""; $pr = ""; $cm = "";
                            if($jenis_kos=='Laki-Laki'){$lk="selected";}
                            elseif($jenis_kos=='Perempuan'){$pr="selected";}
                            else{$cm="selected";}
                        ?>
                        <option value="Laki-Laki" <?= $lk ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= $pr ?>>Perempuan</option>
                        <option value="Campur" <?= $cm ?>>Campur</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <?php
                        //jika set value alamat tidak kosong maka isi $alamat diganti dengan isian dari user
                        if(strlen(set_value('alamat'))>0){
                          $alamat = set_value('alamat');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat?>" placeholder="Diisi dengan Alamat">
                </div>
                <div class="mb-3">
                    <label for="telepon">Telepon</label> 
                    <?php
                        //jika set value telepon tidak kosong maka isi $telepon diganti dengan isian dari user
                        if(strlen(set_value('telepon'))>0){
                          $telepon = set_value('telepon');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $telepon?>" placeholder="Diisi dengan Nomor Telepon (081321405677)">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
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
