<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Form</h1>
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
      ?>
        <div class="row">
        <?= form_open_multipart('helloworld/inputForm') ?>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal')?>" placeholder="Diisi dengan tanggal">
                </div>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="datetime-local" class="form-control" id="waktu" name="waktu" value="<?= set_value('waktu')?>" placeholder="Diisi dengan waktu">
                </div>
                <div class="mb-3">
                    <label for="dokumen">Dokumen</label>
                    <input type="file" class="form-control" id="dokumen" name="dokumen" value="<?= set_value('dokumen')?>">
                </div>
                <div class="mb-3">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" value="<?= set_value('gambar')?>" >
                </div>
                <div class="mb-3">
                    <?php
                      //memberi notasi checked jika sudah dipilih
                      $male=""; $female = ""; $other = "";
                      if(set_value('gender')=='male'){$male="checked";}
                      elseif(set_value('gender')=='female'){$female="checked";}
                      elseif(set_value('gender')=='other'){$other="checked";}
                      
                    ?>
                    <label for="gender">Jenis</label><br>
                    <input type="radio" id="male" name="gender" value="male" <?= $male ?>><label for="male">Male</label><br>
                    <input type="radio" id="female" name="gender" value="female" <?= $female ?>><label for="female">Female</label><br>
                    <input type="radio" id="other" name="gender" value="other" <?= $other ?>><label for="other">Other</label>
                </div>
                <div class="mb-3">
                <label for="hobi">Hobi</label><br>
                    <?php
                      //print_r(set_value('hobi'));
                      $a  = set_value('hobi');
                      if(is_array($a)){
                        ?>
                          <input type="checkbox" id="hobi[]" name="hobi[]" value="Musik" <?= in_array("Musik", set_value('hobi')) ? "checked" : ""; ?>><label for="hobi1"> Musik</label><br>
                          <input type="checkbox" id="hobi[]" name="hobi[]" value="Renang" <?= in_array("Renang", set_value('hobi')) ? "checked" : ""; ?>><label for="hobi2"> Renang</label><br>
                          <input type="checkbox" id="hobi[]" name="hobi[]" value="Badminton" <?= in_array("Badminton", set_value('hobi')) ? "checked" : ""; ?>><label for="hobi3"> Badminton</label><br><br>
                        <?php
                      }else{
                        ?>
                          <input type="checkbox" id="hobi[]" name="hobi[]" value="Musik" ><label for="hobi1"> Musik</label><br>
                          <input type="checkbox" id="hobi[]" name="hobi[]" value="Renang" ><label for="hobi2"> Renang</label><br>
                          <input type="checkbox" id="hobi[]" name="hobi[]" value="Badminton" ><label for="hobi3"> Badminton</label><br><br>
                        <?php
                      }
                    ?>
                    
                    
                          
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
