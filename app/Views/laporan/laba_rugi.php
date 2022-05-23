<?php
$pendapatan = 0;
$pembelian = 0;
$beban = 0;
foreach ($jurnal as $value) {
  if ($value['no_reff'] == '411') {
    $pendapatan = $pendapatan + $value['saldo'];
  }
  if ($value['no_reff'] == '412') {
    $pembelian = $pembelian + $value['saldo'];
  }
  if ($value['no_reff'] == '512') {
    $beban = $beban + $value['saldo'];
  }
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Laba Rugi</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <a href="<?= base_url('Laporan/print_laba_rugi')?>" type="button" class="btn btn-sm btn-outline-secondary">Cetak</a>
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
  </div>

  <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

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

  <div class="table-responsive">
    <table class="table table-bordered">
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
          <td colspan="4">Pembelian</td>
          <td colspan="3"><?= $pembelian ?></td>
        </tr>

        <tr>
          <td colspan="4">Beban</td>
          <td colspan="3"><?= $beban ?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">Total</td>
          <td colspan="3"><?= $pendapatan-$pembelian-$beban ?></td>
        </tr>
      </tfoot>
    </table>
  </div>

</main>
</div>
</div>


<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
</body>

</html>