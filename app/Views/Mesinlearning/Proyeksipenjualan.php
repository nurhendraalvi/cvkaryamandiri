<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js">    </script>


    <title>Hello, world!</title>
  </head>
  <body>
  
  <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">Proyeksi Penjualan</a>
    </nav>  

<div class="container">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Order Date</th>
            <th scope="col">Penjualan H</th>
            <th scope="col">Penjualan H+1</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $array_revenue = array();
                    $jml_data = count($hasil);
                    foreach($hasil as $dt){
                        array_push($array_revenue,$dt->revenue);
                    }
                    $i = 1; $dataHplus1 = 0;
                    foreach($hasil as $dt){
                            if($i<count($array_revenue)){
                                $dataHplus1 = $array_revenue[$i];
                            }else{
                                $dataHplus1 = $Proyeksi; //ambil dari perhitungan di kontroller
                            }
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i;?></th>
                            <td><?php echo $dt->OrderDate;?></td>
                            <td><?php echo number_format($dt->revenue);?></td>
                            <td><?php echo number_format($dataHplus1);?></td>
                        </tr>
                        <?php
                        $i++;
                    }
            ?>  
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Penjualan H</th>
                    <th scope="col">Penjualan H+1</th>
                </tr>
            </tfoot>
        </tbody>
        </table>
</div>        
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>                
  </body>
</html>