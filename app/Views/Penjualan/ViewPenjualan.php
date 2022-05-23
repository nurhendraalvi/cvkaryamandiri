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
                   <thead align="center">
                      <tr>
                         <th>Nama Mainan</th>
                         <th>Harga</th>
                         <th>Aksi</th>
                      </tr>
                   </thead>
                   <tbody align="center">
                    
                        <?php //$total_sum=0; 
                        foreach($mainan as $row){ ?>
                     <tr>
                         <td><?php echo $row->nama_mainan; ?></td>
                         <td><?php echo $row->harga_jual; ?></td> 
                         <td><a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->id_mainan;?>" data-name="<?= $row->nama_mainan;?>" data-price="<?= $row->harga_jual;?>" data-stock="<?= $row->stok_mainan;?>">Beli</a></td>
                      </tr>
                     <?php } ?>
                           
                    </tbody>
                 </table >
                 <a href="<?php echo base_url('CPenjualan/CheckOutView'); ?>" class="btn btn-info btn-user btn-block">Check Out</a>
                </div>
        <!-- Modal Edit Product-->
            <form action="<?php echo base_url('CPenjualan/Insertdummy'); ?>" method="POST">
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Beli Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label>Nama Mainan</label>
                            <input type="text" class="form-control nama_mainan" name="nama_mainan" placeholder="Product Name">
                        </div>
                        
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control harga_jual" name="harga_jual" placeholder="Product Price">
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control quantity" name="quantity" placeholder="Product Price">
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
      <!--</form>-->
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
            const name = $(this).data('name');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
            // Set data to Form Edit
            $('.id_mainan').val(id);
            $('.nama_mainan').val(name);
            $('.harga_jual').val(price);
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