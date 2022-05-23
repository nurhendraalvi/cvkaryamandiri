<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="<?= base_url('js/Chart.bundle.js') ?>"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
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
