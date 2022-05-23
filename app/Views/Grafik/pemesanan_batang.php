<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Grafik</h1>
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

        <div class="row">
                
                <div class="mb-3">
                  <?= form_open('grafik/tren_pemesanan') ?>
                  <div class="row">
                    <div class="col-2">
                      <label for="tahun" class="form-label">Pilih Tahun</label>
                    </div>
                    <div class="col-8">
                        <select class="form-select" aria-label="Default select example" id="tahun" name="tahun">
                            <?php
                                //looping penghuni
                                foreach($hasil as $row):
                                    $tahun = $row->tahun;
                                    ?>
                                      <option value="<?= $tahun ?>"><?= $tahun?></option>
                                    <?php
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-2">
                      <button type="submit" class="btn btn-primary">Proses</button>    
                    </div>
                  </div>
                      
                  </div>

                </form>

                <div class="mb-3">
                <?php
                        foreach($hasil as $dt){
                            $Bulan[] = $dt->tgl_pemesanan;
                            $jml_pesanan[] = $dt->total_pemesanan;
                            $jml_pembayaran[] = $dt->total_bayar;
                        }
                        //echo json_encode($chart);
                ?>   
 
                    <div id="canvas-holder" style="width:50%">
                        <canvas id="chart" width="300" height="300" />
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
        type: 'bar',
        data: {
            datasets: [
                {
                    label: 'Jml Pemesanan',
                    data: <?php echo json_encode($jml_pesanan);?>,
                    backgroundColor: "rgba(255,0,0,0.5)"
                },
                {
                    label: 'Jml Pembayaran',
                    data: <?php echo json_encode($jml_pembayaran);?>,
                    backgroundColor: "rgba(0,0,0,0.5)"
                }
            ],
            labels: <?php echo json_encode($Bulan);?>
        },
        options: {
            responsive: true,
            legend: {
                        position: 'top',
                    },
            title: {
				display: true,
				text: 'Grafik Tren Pemesanan'
			}
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart").getContext("2d");
        window.myLine  = new Chart(ctx, config);
    };
    </script>                    

 
  </body>
</html>
