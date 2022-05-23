<!doctype html>
<html>

<head>
    <title>Pie Chart</title>
    <script src="<?= base_url('js/Chart.bundle.js') ?>"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
    <?php
        foreach($hasil as $dt){
            $Region[] = $dt->Region;
            $TotalPendapatan[] = $dt->TotalPendapatan;
            $warna[] = $dt->warna;
        }
		//echo json_encode($Region);
     ?>   
    <div id="canvas-holder" style="width:50%">
        <canvas id="chart-area" width="300" height="300" />
    </div>
    <script>

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo json_encode($TotalPendapatan);?>,
                backgroundColor: <?php echo json_encode($warna);?>,
            }],
            labels: <?php echo json_encode($Region);?>
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            }
        },
        
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };
    </script>
</body>

</html>
