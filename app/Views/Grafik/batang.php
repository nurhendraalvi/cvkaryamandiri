<!doctype html>
<html>

<head>
    <title>Grafik Batang</title>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?= base_url('js/Chart.bundle.js') ?>"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<body>
     <?php
        foreach($hasil as $dt){
            $hari[] = $dt->Hari;
            $jumlah_penjualan[] = $dt->totalpenjualan;
            $jumlah_biaya[] = $dt->totalbiaya;
            $jumlah_profit[] = $dt->totalpendapatan;
        }
     ?>   

    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>

    <script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var barChartData = {
            labels: <?php echo json_encode($hari);?>,
            datasets: [{
                label: 'Penjualan',
                backgroundColor: "rgba(0,0,0,0.5)",
                data: <?php echo json_encode($jumlah_penjualan);?>
            }, {
                label: 'Biaya',
                backgroundColor: "rgba(0,9,255,0.5)",
                data: <?php echo json_encode($jumlah_biaya);?>
            }, {
                label: 'Profit',
                backgroundColor: "rgba(255,0,0,0.7)",
                data: <?php echo json_encode($jumlah_profit);?>
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each bar to be 2px wide and green

                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Grafik Penjualan, Biaya dan Laba'
                    },
                    axisY:{
                        valueFormatString: "$#,###,#0", //try properties here
                    }
                }
            });

        };

        
    </script>
</body>

</html>
