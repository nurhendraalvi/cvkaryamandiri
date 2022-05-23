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
        Jurnal Umum Coin Laundry
</center>
<table border="1" width="100%">
    <thead>
        <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama Akun</th>
            <th scope="col">Ref</th>
            <th scope="col">Debet</th>
            <th scope="col">Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $data) : ?>
            <tr>
                <td><?= $data['tgl_transaksi'] ?></td>
                <td><?= $data['nama_akun'] ?></td>
                <td><?= $data['no_reff'] ?></td>
                <?php if ($data['jenis_saldo'] == 'debit') { ?>
                    <td><?= number($data['saldo']) ?></td>
                    <td>-</td>
                <?php
                    $debit = $debit + $data['saldo'];
                } elseif ($data['jenis_saldo'] == 'kredit') { ?>
                    <td>-</td>
                    <td><?= number($data['saldo']) ?></td>
                <?php
                    $kredit = $kredit + $data['saldo'];
                } ?>
            </tr>
        <?php
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Jumlah Total</td>
            <td><?= number($debit) ?></td>
            <td><?= number($kredit) ?></td>
        </tr>
    </tfoot>
</table>