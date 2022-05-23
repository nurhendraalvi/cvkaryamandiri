<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>
        <br>
        <div class="row">
          <div class="col-2">
              Pilih Kosan
          </div>
          <div class="col-8">
            <?= form_open('grafik/okupansi_kamar') ?>
            <select class="form-select" aria-label="Default select example" id="id_kos" name="id_kos">
            <?php
                  //looping penghuni
                  foreach($koskosan as $row):
                      $id_kos = $row['id_kos'];
                      $nama = $row['nama'];
                      ?>
                        <option value="<?= $id_kos ?>"><?= $nama?></option>
                      <?php
                  endforeach;
            ?>
            </select>
          </div>
          <div class="col-2">
            <button type="submit" class="btn btn-primary">Proses</button>    
          </div>
          </form>
        </div>

        <div class="row">
              <div class="mb-3">
              <?php
                      foreach($hasil as $dt){
                          $status[] = $dt->status;
                          $TotalKamar[] = $dt->TotalKamar;
                          $warna[] = $dt->warna;
                      }
                      //echo json_encode($Region);
              ?>   

                  <div id="canvas-holder" style="width:50%">
                      <canvas id="chart-area" width="300" height="300" />
                  </div>
              </div>    
                
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

    <script>

    var config = {
        type: 'pie',
        data: {
            datasets: [
                {
                    label: <?php echo json_encode($status);?>,
                    data: <?php echo json_encode($TotalKamar);?>,
                    backgroundColor: <?php echo json_encode($warna);?>,
                }
            ],
            labels: <?php echo json_encode($status);?>
        },
        options: {
            responsive: true,
            title: {
				display: true,
				text: 'Grafik Okupansi Kamar'
			}
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myLine  = new Chart(ctx, config);
    };
    </script>                    


  </body>
</html>
