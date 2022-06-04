<?php
function number($angka)
{
    $hasil_number = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_number;
} ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Buku Besar</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= base_url('laporan/print_buku_besar') ?>" type="button" class="btn btn-sm btn-outline-secondary me-2">Cetak Buku Besar</a>
            </div>
        </div>
    </div>

    <div class="row">
         <form action="<?php echo base_url().'/Laporan/bukubesar2/'?>" method="POST">
        <div class="row">
            <table><tr><td>
             <table align="center">
             <tr>
                 <td><label for="nama_vendor" class="form-label">Tahun Buku Besar</label></td>
                 <td>
                     <select name="tahun" class="custom-select">
                            <option> --- Pilih Tahun --- </option>
                         <?php foreach ($year as $key) { ?>
                            <option value="<?php $key->tahun;?>"><?php echo $key->tahun;?></option>
                         <?php } ?>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td><label for="nama_vendor" class="form-label">Bulan Buku Besar</label></td>
                 <td>
                     <select class="custom-select" name="bulan">
                         <option> --- Pilih Bulan --- </option>
                         <option value="1">January</option>
                         <option value="2">February</option>
                         <option value="3">March</option>
                         <option value="4">April</option>
                         <option value="5">May</option>
                         <option value="6">June</option>
                         <option value="7">July</option>
                         <option value="8">August</option>
                         <option value="9">September</option>
                         <option value="10">Octover</option>
                         <option value="11">November</option>
                         <option value="12">December</option>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td><label for="nama_vendor" class="form-label">Akun</label></td>
                 <td>
                     <select name="akun" class="custom-select">
                            <option> --- Pilih Akun --- </option>
                            <option value="111"> Kas </option>
                            <option value="411"> Penjualan </option>
                            <option value="401"> Pembelian </option>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td><button type="submit" class="btn btn-primary prosesbukubesar">Submit</button></td>
             </tr>
         </table>
         </td></tr></table>
        </div>
         
        </form>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <?php 
            foreach ($BigBook as $data)  { 
                $akun = $data->nama_coa;
                $bln = $data->bulan;
                $thn = $data->tahun;
            }
         ?>
        <center><label><h5>Buku Besar <?php echo $akun; ?></h5></label></center>
        <center><label><h6>Periode <?php echo $bln." ".$thn; ?></h6></label></center>
        <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th rowspan="2" align="center">Tanggal</th>
                <th rowspan="2" align="center">Nama Akun</th>
                <th rowspan="2" align="center">Keterangan</th>
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
            foreach ($BigBook as $data)  { ?>
                    <tr>
                        <td><?php echo $data->tgl_jurnal; ?></td>
                        <td><?php echo $data->nama_coa; ?></td>
                        <td><?php echo $data->transaksi; ?></td>
                        <td><?php echo $data->kode_akun; ?></td>
                        <?php if ($data->posisi_d_c == 'd') {
                            $debit = $debit + $data->nominal; ?>
                            <td><?= number($data->nominal) ?></td>
                            <td>-</td>
                            <td><?= number($debit - $kredit) ?></td>
                            <td>-</td>
                        <?php

                        } elseif ($data->posisi_d_c == 'c') {
                            $kredit = $kredit + $data->nominal; ?>
                            <td>-</td>
                            <td><?= number($data->nominal) ?></td>
                            <td>-</td>
                            <td><?= number($debit - $kredit) ?></td>
                        <?php
                        } ?>
                    </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" align="right">Jumlah Total</td>
                <td><?= number($debit) ?></td>
                <td><?= number($kredit) ?></td>
            </tr>
        </tfoot>
    </table>
    </div>
    
</main>
<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

</body>

</html>