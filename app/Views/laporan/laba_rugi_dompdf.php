<?php
$pendapatan = 0;
$beban = 0;
foreach ($jurnal as $value) {
  if ($value['no_reff'] == '411') {
    $pendapatan = $pendapatan + $value['saldo'];
  }
  if ($value['no_reff'] == '512') {
    $beban = $beban + $value['saldo'];
  }
}
?>

<style>
  table {
    border-collapse: collapse;
    margin-bottom: 20px;
  }
</style>

<center>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="text-center">Coin Laundry</div>
          <div class="text-center"><b>Laporan Laba Rugi</b></div>
        </div>
      </div>
    </div>
  </div>
</center>

<table border="1" width="100%">
  <thead>
    <tr>
      <th colspan="7">Perhitungan Laba Rugi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="4">Pendapatan</td>
      <td colspan="3"><?= $pendapatan ?></td>
    </tr>

    <tr>
      <td colspan="4">Beban</td>
      <td colspan="3"><?= $beban ?></td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4">Total</td>
      <td colspan="3"><?= $pendapatan - $beban ?></td>
    </tr>
  </tfoot>
</table>