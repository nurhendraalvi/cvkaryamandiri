<?php
function number($angka)
{
    $hasil_number = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_number;
} ?>

<style>
    table {
        border-collapse: collapse;
        margin-bottom: 20px;
    }
</style>
<center>
    Rincian Pemesanan
</center>
<table border="1" width="100%">
    <thead>
        <tr>
        <th scope="col">Id</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Menu</th>
                <th scope="col">Qty</th>
                <th scope="col">Harga</th>
                <th scope="col">Total pesan</th>
                <th scope="col">Total bayar</th>
        </tr>
    </thead>
    <tbody>
        <?php
          $harga = [];
          $total_pesan = [];
          $total_bayar = [];
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $data) : ?>
            <?php
        array_push($harga, $data->harga);
        array_push($total_pesan, $data->total_pesan);
        array_push($total_bayar, $data->total_bayar);
            ?>
            <tr>
            <td><?= $data->id ?></td>
                    <td><?= $data->tgl ?></td>
                    <td><?= $data->nama_menu ?></td>
                    <td><?= $data->qty ?></td>
                    <td><?= number($data->harga) ?></td>
                    <td><?= number($data->total_pesan) ?></td>
                    <td><?= number($data->total_bayar) ?></td>

            </tr>
        <?php
        endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
                <th colspan="5">harga</th>
                <th colspan="2"><?= number(array_sum($harga)) ?></th>

            </tr>
            <tr>
                <th colspan="5">Total Pesan</th>
                <th colspan="2"><?= number(array_sum($total_pesan)) ?></th>

            </tr>
            <tr>
                <th colspan="5">Total Bayar </th>
                <th colspan="2"><?= number(array_sum($total_bayar)) ?></th>

            </tr>

    </tfoot>
</table>