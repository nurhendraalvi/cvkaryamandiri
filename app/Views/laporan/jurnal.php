<?php
function number($angka)
{
    $hasil_number = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_number;
} ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <?php foreach ($jurnal as $key) { 
                $bln = $key->bulan;
                $yr = $key->tahun;
             } ?>

        <h1 class="h2">Jurnal Umum <?php echo $bln." ".$yr; ?></h1>
         
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= base_url('laporan/print_jurnal') ?>" type="button" class="btn btn-sm btn-outline-secondary me-2">Cetak Jurnal</a>
            </div>
        </div>
    </div>
    <center>
             <div class="row">
             <table><tr><td>
                <form action="<?php echo base_url('Laporan/jurnal2'); ?>" method="POST">
                    <table align="center">
                        <tr>
                            <td>
                                <select name="year" id="inputState" class="form-control">
                                                
                                    <?php 
                                        foreach ($ketTahun as $key) {
                                            echo "<option value='$key->tahun'>".$key->tahun."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="month" id="inputState" class="form-control">
                                                
                                    <?php 
                                        foreach ($ketTahun as $key) {
                                            echo "<option value='$key->bulan'>".$key->bulan."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block">
                            </td>
                        </tr>
                    </table>
                </form>
            </td></tr></table>
         </div>
         </center>
         <br>
    <!-- edit -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
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
            $no = 1;
            foreach ($jurnal as $data) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data->tgl_jurnal; ?></td>
                    <td><?php echo $data->nama_coa; ?></td>
                    <td><?php echo $data->kode_akun; ?></td>
                    <?php if ($data->posisi_d_c == 'd') { ?>
                        <td><?= number($data->nominal) ?></td>
                        <td></td>
                    <?php
                        $debit = $debit + $data->nominal;
                    } elseif ($data->posisi_d_c == 'c') { ?>
                        <td>-</td>
                        <td><?= number($data->nominal) ?></td>
                    <?php
                        $kredit = $kredit + $data->nominal;
                    } ?>
                </tr>
            <?php
            endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Jumlah Total</td>
                <td><?= number($debit) ?></td>
                <td><?= number($kredit) ?></td>
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