<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Kosan</title>
</head>
<body>
    <h1 align="center"> Data Kosan </h1>
    <table border=1 align="center">
        <tr><td>Id Kos</td>
            <td>Nama Kos</td>
            <td>Jenis Kos</td>
            <td>Alamat</td>
        </tr>
        <?php
            foreach($koskosan as $row):
                ?>
                    <tr>
                        <td><?= $row['id_kos'];?></td>
                        <td><?= $row['nama'];?></td>
                        <td><?= $row['jenis_kos'];?></td>
                        <td><?= $row['alamat'];?></td>
                    </tr>
                <?php
            endforeach;    
            ?>
        </table>
    </body>
    </html>