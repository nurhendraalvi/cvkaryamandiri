<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Coin Laundry </h1>
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

    <h2>Data Pemesanan</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tanggal</th>
                    <th>Nama Pemesanan</th>
                    <th>Total Pemesanan</th>
                    <th>Total Bayar</th>
                    <th>Sisa Bayar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pemesanan as $row) :
                    $sisa = $row['total_pemesanan'] - $row['total_bayar'];
                    $id = $row['id'];
                ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['tgl_pemesanan']; ?></td>
                        <td><?= $row['nama_pemesanan']; ?></td>
                        <td><?= $row['total_pemesanan']; ?></td>
                        <td><?= $row['total_bayar']; ?></td>
                        <td><?= $sisa; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBayar<?= $id ?>">Bayar</button>
                        </td>
                    </tr>

                    <!-- Modal Tambah -->
                    <div class="modal fade mt-5 pt-5" id="modalBayar<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
                                </div>
                                <form action="<?= base_url('/Pemesanan/pembayaran/' . $id); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="productname"><strong>Total Pemesanan</strong></label>
                                            <input class="form-control" type="text" value="<?= $row['total_pemesanan']; ?>" disabled>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="productname"><strong>Total Bayar</strong></label>
                                            <input class="form-control" type="text" value="<?= $row['total_bayar']; ?>" disabled>
                                            <input class="form-control" type="hidden" value="<?= $row['total_bayar']; ?>" name="biaya_masuk">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="productname"><strong>Sisa Bayar</strong></label>
                                            <input class="form-control" type="text" value="<?= $sisa; ?>" name="sisa" disabled>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="productname"><strong>Pembayaran</strong></label>
                                            <input class="form-control" type="text" placeholder="Masukan biaya yang kurang" name="bayar" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal -->
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <p>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('Pemesanan/inputdata') ?>" class="btn btn-warning" id="tmbh">Tambah Data Pemesanan</a>
                </div>
            </div>
        </div>
    </div>


</main>
</div>
</div>


<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
</body>

</html>