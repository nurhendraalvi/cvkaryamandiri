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
                <?php
                        foreach($hasil as $dt){
                            $Bulan[] = $dt->Bulan;
                            $total[] = $dt->total;
                            $total_profit[] = $dt->total_profit;
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
        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Total Penjualan',
                    data: <?php echo json_encode($total);?>,
                    fill:"false",
                    "borderColor":"rgb(75, 192, 192)",
                    "lineTension":0
                },
                {
                    label: 'Total Profit',
                    data: <?php echo json_encode($total_profit);?>,
                    fill:"false",
                    "borderColor": "rgb(255, 0, 0)",
                    "lineTension":0
                }
            ],
            labels: <?php echo json_encode($Bulan);?>
        },
        options: {
            responsive: true,
            title: {
				display: true,
				text: 'Grafik Penjualan'
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
