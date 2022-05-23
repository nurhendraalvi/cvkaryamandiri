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
    Buku Besar Coin Laundry
</center>

<div> No Akun : 111 (Kas)</div>
<table border="1" width="100%">
    <thead>
        <tr>
            <th rowspan="2" align="center">Tanggal</th>
            <th rowspan="2" align="center">Nama Akun</th>
            <th rowspan="2" align="center">Ref</th>
            <th rowspan="2" align="center">Debet</th>
            <th rowspan="2" align="center">Kredit</th>
            <th colspan="2" align="center">Saldo</th>
        </tr>
        <tr>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $data) :
            if ($data['no_reff'] == '111') { ?>
                <tr>
                    <td><?= $data['tgl_transaksi'] ?></td>
                    <td><?= $data['nama_akun'] ?></td>
                    <td><?= $data['no_reff'] ?></td>
                    <?php if ($data['jenis_saldo'] == 'debit') {
                        $debit = $debit + $data['saldo']; ?>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                        <td>-</td>
                    <?php

                    } elseif ($data['jenis_saldo'] == 'kredit') {
                        $kredit = $kredit + $data['saldo']; ?>
                        <td>-</td>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                    <?php
                    } ?>
                </tr>
        <?php }
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Jumlah Total</td>
            <td><?= number($debit) ?></td>
            <td><?= number($kredit) ?></td>
        </tr>
    </tfoot>
</table>


<div> No Akun : 112 (Piutang)</div>
<table border="1" width="100%">
    <thead>
        <tr>
            <th rowspan="2" align="center">Tanggal</th>
            <th rowspan="2" align="center">Nama Akun</th>
            <th rowspan="2" align="center">Ref</th>
            <th rowspan="2" align="center">Debet</th>
            <th rowspan="2" align="center">Kredit</th>
            <th colspan="2" align="center">Saldo</th>
        </tr>
        <tr>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $data) :
            if ($data['no_reff'] == '112') { ?>
                <tr>
                    <td><?= $data['tgl_transaksi'] ?></td>
                    <td><?= $data['nama_akun'] ?></td>
                    <td><?= $data['no_reff'] ?></td>
                    <?php if ($data['jenis_saldo'] == 'debit') {
                        $debit = $debit + $data['saldo']; ?>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                        <td>-</td>
                    <?php

                    } elseif ($data['jenis_saldo'] == 'kredit') {
                        $kredit = $kredit + $data['saldo']; ?>
                        <td>-</td>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                    <?php
                    } ?>
                </tr>
        <?php }
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Jumlah Total</td>
            <td><?= number($debit) ?></td>
            <td><?= number($kredit) ?></td>
        </tr>
    </tfoot>
</table>


<div> No Akun : 411 (Pendapatan)</div>
<table border="1" width="100%">
    <thead>
        <tr>
            <th rowspan="2" align="center">Tanggal</th>
            <th rowspan="2" align="center">Nama Akun</th>
            <th rowspan="2" align="center">Ref</th>
            <th rowspan="2" align="center">Debet</th>
            <th rowspan="2" align="center">Kredit</th>
            <th colspan="2" align="center">Saldo</th>
        </tr>
        <tr>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $data) :
            if ($data['no_reff'] == '411') { ?>
                <tr>
                    <td><?= $data['tgl_transaksi'] ?></td>
                    <td><?= $data['nama_akun'] ?></td>
                    <td><?= $data['no_reff'] ?></td>
                    <?php if ($data['jenis_saldo'] == 'debit') {
                        $debit = $debit + $data['saldo']; ?>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                        <td>-</td>
                    <?php

                    } elseif ($data['jenis_saldo'] == 'kredit') {
                        $kredit = $kredit + $data['saldo']; ?>
                        <td>-</td>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                    <?php
                    } ?>
                </tr>
        <?php }
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Jumlah Total</td>
            <td><?= number($debit) ?></td>
            <td><?= number($kredit) ?></td>
        </tr>
    </tfoot>
</table>


<div> No Akun : 512 (Beban Gaji)</div>
<table border="1" width="100%">
    <thead>
        <tr>
            <th rowspan="2" align="center">Tanggal</th>
            <th rowspan="2" align="center">Nama Akun</th>
            <th rowspan="2" align="center">Ref</th>
            <th rowspan="2" align="center">Debet</th>
            <th rowspan="2" align="center">Kredit</th>
            <th colspan="2" align="center">Saldo</th>
        </tr>
        <tr>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $debit = 0;
        $kredit = 0;
        foreach ($jurnal as $data) :
            if ($data['no_reff'] == '512') { ?>
                <tr>
                    <td><?= $data['tgl_transaksi'] ?></td>
                    <td><?= $data['nama_akun'] ?></td>
                    <td><?= $data['no_reff'] ?></td>
                    <?php if ($data['jenis_saldo'] == 'debit') {
                        $debit = $debit + $data['saldo']; ?>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                        <td>-</td>
                    <?php

                    } elseif ($data['jenis_saldo'] == 'kredit') {
                        $kredit = $kredit + $data['saldo']; ?>
                        <td>-</td>
                        <td><?= number($data['saldo']) ?></td>
                        <td>-</td>
                        <td><?= number($debit - $kredit) ?></td>
                    <?php
                    } ?>
                </tr>
        <?php }
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Jumlah Total</td>
            <td><?= number($debit) ?></td>
            <td><?= number($kredit) ?></td>
        </tr>
    </tfoot>
</table>