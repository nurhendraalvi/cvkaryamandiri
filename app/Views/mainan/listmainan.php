<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">CV Karya Mandiri</h1>
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

      <h2>Data Mainan</h2>
      <div class="row">
              <div class="col">
                  <div class="card">
                    <div class="card-body">
                    <a href="<?= base_url('mainan/inputmainan') ?>" class="btn btn-warning" id="tmbh">Tambah Data Mainan</a>
                    </div>
                  </div>
              </div>
            </div> 

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Id Mainan</th>
              <th>Nama vendor</th>
              <th>Nama Mainan</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Stok Mainan</th>
            </tr>
          </thead>
          <tbody>
                <?php
                    foreach($Mainan as $row):
                        ?>
                            <tr>
                                <td><?= $row->id_mainan;?></td>
                                <td><?= $row->nama_vendor;?></td>
                                <td><?= $row->nama_mainan;?></td>
                                <td><?= $row->harga_beli;?></td>
                                <td><?= $row->harga_jual;?></td>
                                <td><?= $row->stok_mainan;?></td>
                              </tr>
                        <?php
                    endforeach;    
                ?>
          </tbody>
        </table>
      </div>

      <p>
            
    </main>
  </div>
</div>


    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" 
      integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" 
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" 
      integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" 
      crossorigin="anonymous"></script>

    <script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
<!--  -->