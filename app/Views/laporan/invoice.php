<?php
function number($angka)
{
    $hasil_number = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_number;
} ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Rincian Pemesanan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <input type="button" class="btn btn-sm btn-outline-secondary me-2" value="Cetak PDF" onclick="window.open('<?= site_url('jurnal/print_invoice') ?>','blank')">
                <?php

                ?>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
            <th scope="col">Id</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Pemesanan</th>
                <th scope="col">Total Pemesanan</th>
                <th scope="col">Total Bayar</th>
                <!-- <th scope="col">Total pesan</th>
                <th scope="col">Total bayar</th> -->
            
            </tr>
        </thead>
        <tbody>
            <?php
                $nama_pemesanan = [];
                $total_pemesanan = [];
                $total_bayar = [];
            $debit = 0;
            $kredit = 0;
            foreach ($jurnal as $data) : ?>
            <?php
                array_push($nama_pemesanan, $data->nama_pemesanan);
                array_push($total_pemesanan, $data->total_pemesanan);
                array_push($total_bayar, $data->total_bayar);
            ?>
                <tr>
                <td><?= $data->id ?></td>
                    <td><?= $data->tgl_pemesanan ?></td>
                    <td><?= $data->nama_pemesanan ?></td>
                    <td><?= number($data->total_pemesanan) ?></td>
                    <td><?= number($data->total_bayar) ?></td>
                   


                </tr>
            <?php
            endforeach; ?>
        </tbody>
        <tfoot>
        <!-- <tr>
                <th colspan="5">Nama Pemesanan</th>
                <th colspan="2"><?= number(array_sum($nama_pemesanan)) ?></th>

            </tr> -->
            <tr>
                <th colspan="5">Total Pemesanan</th>
                <th colspan="2"><?= number(array_sum($total_pemesanan)) ?></th>

            </tr>
            <tr>
                <th colspan="5">Total Bayar </th>
                <th colspan="2"><?= number(array_sum($total_bayar)) ?></th>

            </tr>

        </tfoot>
    </table>

</main>
<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

</body>

</html>