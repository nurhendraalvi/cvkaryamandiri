<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pilih Pembelian </h1>
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
         <div class="mt-3">
     <table class="table table-bordered" id="users-list">
       <thead>
          <tr>
             <th>Nama Vendor</th>
             <th>Mainan</th>
             <th>Harga Beli</th>
             <th>Order</th>
          </tr>
       </thead>
       <tbody>
          <?php foreach($pembelian as $row){ ?>
          <tr>
             <td><?php echo $row->nama_vendor; ?></td>
             <td><?php echo $row->nama_mainan; ?></td>
             <td><?php echo $row->harga_beli; ?></td>
             <!--<td>
              <a href="<?php //echo base_url('Pembelian/SellForm/'.$data->id_mainan);?>" class="btn btn-primary btn-sm">Pesan</a>
              </td>-->
              <td><a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->id_mainan;?>" data-vendor="<?= $row->nama_vendor;?>" data-name="<?= $row->nama_mainan;?>" data-price="<?= $row->harga_beli;?>" data-stock="<?= $row->stok_mainan;?>">Pesan</a></td>
          </tr>
         <?php } ?>
       </tbody>
     </table>
  </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
              $('#users-list').DataTable();
          } );
        </script>      

     </div>
    
    <!-- Modal Edit Product-->
            <form action="<?php echo base_url('Pembelian/inputdata'); ?>" method="POST">
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pesan Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label>Nama Vendor</label>
                            <input type="text" class="form-control nama_vendor" name="nama_vendor" placeholder="Product Name">
                        </div>

                        <div class="form-group">
                            <label>Nama Mainan</label>
                            <input type="text" class="form-control nama_mainan" name="nama_mainan" placeholder="Product Name">
                        </div>
                        
                        <div class="form-group">
                            <label>Harga Beli</label>
                            <input type="text" class="form-control harga_beli" name="harga_beli" placeholder="Product Price">
                        </div>

                        <div class="form-group">
                            <label>Jumlah Mainan</label>
                            <input type="number" class="form-control jumlah_mainan" name="jumlah_mainan" placeholder="Product Price">
                            <input type="hidden" class="form-control stock" name="stock" placeholder="Product Price">
                            <input type="hidden" class="form-control id_mainan" name="id_mainan" placeholder="Product Price">
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_mainan" class="id_mainan">
                        <input type="hidden" name="stok_mainan" class="stok_mainan">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Beli</button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            <!-- End Modal Edit Product-->

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
              $('#users-list').DataTable();
          } );
        </script>      

     </div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){

        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const vendor = $(this).data('vendor');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
            // Set data to Form Edit
            $('.id_mainan').val(id);
            $('.nama_vendor').val(vendor);
            $('.nama_mainan').val(name);
            $('.harga_beli').val(price);
            $('.stok_mainan').val(stock);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
        
    });
</script>


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