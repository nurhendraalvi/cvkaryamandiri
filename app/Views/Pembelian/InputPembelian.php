0<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pembelian </h1>
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
    if (isset($validation)) {
        echo $validation->listErrors();
    }
    ?>
    
    <div class="row">
        
        <?php 
            foreach ($pembelian as $dataItem) {
                $id = $dataItem->id_mainan;
         ?>
         <form action="<?php echo base_url().'/Pembelian/inputdata/'?>" method="POST">
         <input type="hidden" name="id_mainan" id="id_mainan" value="<?php echo $dataItem->id_mainan; ?>">
        <div class="mb-3">
            <label for="nama_vendor" class="form-label">Nama Vendor</label>
            <input type="text" class="form-control" disabled value="<?php echo $dataItem->nama_vendor; set_value('nama_vendor');?>">
            <input type="hidden" class="form-control" id="nama_vendor" name="nama_vendor" value="<?php echo $dataItem->nama_vendor; set_value('nama_vendor');?>">
        </div>
        <div class="mb-3">
            <label for="nama_mainan" class="form-label">Nama Mainan</label>
            <input type="text" class="form-control" disabled value="<?php echo $dataItem->nama_mainan; set_value('nama_mainan');?>">
            <input type="hidden" class="form-control" id="nama_mainan" name="nama_mainan" value="<?php echo $dataItem->nama_mainan; set_value('nama_mainan');?>">
        </div>
        <input type="hidden" name="stock" value="<?php echo $dataItem->stok_mainan; set_value('stok_mainan');?>">
        <div class="mb-3">
            <label for="jumlah_mainan" class="form-label">Jumlah Mainan</label>
            <input type="text" class="form-control" id="jumlah_mainan" name="jumlah_mainan" value="<?= set_value('jumlah_mainan') ?>" placeholder="Diisi dengan jumlah mainan" onkeyup="sum();" >
        </div>
        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="text" class="form-control" disabled value="<?php echo $dataItem->harga_beli; set_value('harga_beli');?>">
            <input type="hidden" class="form-control" id="Harga_Beli" name="harga_beli" value="<?php echo $dataItem->harga_beli; set_value('harga_beli'); ?>" onkeyup="sum();" >
        </div>
        <div class="mb-3">
            <label for="total_pembelian" class="form-label">Total Pembelian</label>
            <input type="text" class="form-control" id="total_pembelian" name="total_pembelian" value="<?= set_value('total_pembelian') ?>" placeholder="Diisi dengan pembelian">
        </div>
        <script>
        function sum() {
                   var txtFirstNumberValue = document.getElementById('jumlah_mainan').value;
                   var txtSecondNumberValue = document.getElementById('Harga_Beli').value;
                   var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
                   if (!isNaN(result)) {
                       document.getElementById('total_pembelian').value = result;
                   }
               }
        </script>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php } ?>
    </div> 


</main>
</div>
</div>

<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
</body>

</html>