<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kedai Lontong Mamak</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

    <h2>Laporan Pemesanan</h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
            <table align="center"><tr><td>
                <form method="POST">
                    <table>
                        <tr>
                            <td>
                                <select name="data" id="inputState" class="form-control">
                                                
                                    <?php 
                                        foreach ($year as $key) {
                                            echo "<option value='$key->tahun'>".$key->tahun."</option>";
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
    <!--<div class="table-responsive">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan Penjualan</th>
                    <th>Total Penjualan</th>
                    <th>Total Penjualan (Rp)</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                //$totals = 0;
                //foreach ($jurnal as $row) :
                ?>
                    <tr>
                        <td><?= $row->tgl_pemesanan; ?></td>
                        <td><?= $row->nama_pemesanan; ?></td>
                        <td><?= $row-> total_pemesanan, $total_pemesanan; ?></td>
                        <td>Rp. <?= number_format($row->total_bayar* $row->total_pemesanan, 0, ",", ".");$totals = $totals+$row->total_bayar* $row->total_pemesanan;?></td>

                        </td>
                    </tr>
                <?php
                //endforeach;
                ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5">Total Bayar</th>
                <th colspan="2">Rp.<?= number_format($totals, 0, ",", "."); ?></th>

        </tfoot>
        </table>
    </div>-->

    <p>



</main>
</div>
</div>
<!-- Modals -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>



<script>
    function deleteConfirm(url) {
        url2 = "<?= base_url('/pemesanan') ?>"; //diisi dengan halaman ini

        var tomboldelete = document.getElementById('btn-delete')
        tomboldelete.setAttribute("href", url); //akan meload kontroller delete

        var tomboldelete = document.getElementById('btn-batal')
        tomboldelete.setAttribute("href", url2); //akan meload halaman ini

        var tombolbatal = document.getElementById('btn-tutup')
        tombolbatal.setAttribute("href", url2); //akan meload halaman ini

        var pesan = "Pembelian Dengan ID <b>"
        var pesan2 = " </b>akan dihapus"
        var n = url.lastIndexOf("/")
        var res = url.substring(n + 1);
        document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

        var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });

        myModal.show();

    }
</script>
<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                <a id="btn-tutup" class="btn btn-secondary" href="#">X</a>
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                <a id="btn-batal" class="btn btn-secondary" href="#">Batalkan</a>
                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>

</html>