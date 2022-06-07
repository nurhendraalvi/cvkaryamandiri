<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input vendor</h1>
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

      <?php
        if(isset($validation))
        {
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('vendor/inputvendor') ?>
                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Nama vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?= set_value('nama_vendor')?>" placeholder="Diisi dengan nama_vendor">
                </div>
                <div class="mb-3">
                    <label for="alamat_vendor" class="form-label">Alamat vendor</label>
                    <input type="text" class="form-control" id="alamat_vendor" name="alamat_vendor" value="<?= set_value('alamat_vendor')?>" placeholder="Diisi dengan alamat_vendor">
                </div>
                <div class="mb-3">
                    <label for="no_telp_vendor" class="form-label">Telepon vendor</label>
                    <input type="text" class="form-control" id="no_telp_vendor" name="no_telp_vendor" value="<?= set_value('no_telp_vendor')?>" placeholder="Diisi dengan no_telp_vendor">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
