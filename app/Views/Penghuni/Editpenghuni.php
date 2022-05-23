<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Penghuni</h1>
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

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }

        //dapatkan data dari koskosan dan simpan ke variabel lokal
        foreach($penghuni as $row):
            $id = $row->id;
            $ktp = $row->ktp;
            $nama = $row->nama;
            $email = $row->email;
            $telepon = $row->telepon;
          endforeach;

      ?>
        <div class="row">
        <?= form_open('penghuni/editpenghuniproses') ?>
        <input type="hidden" id="id" name="id" value="<?= $id?>">
                <div class="mb-3">
                    <label for="ktp" class="form-label">Nomer KTP</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('ktp'))>0){
                          $ktp = set_value('ktp');
                        }
                    ?>
                    <input type="text" class="form-control" id="ktp" name="ktp" value="<?= $ktp?>" placeholder="Diisi dengan nomer KTP">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('nama'))>0){
                          $ktp = set_value('nama');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama?>" placeholder="Diisi dengan nama">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('email'))>0){
                          $ktp = set_value('email');
                        }
                    ?>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $email?>" placeholder="Diisi dengan Email (hendro@gmail.com)">
                </div>
                <div class="mb-3">
                    <label for="telepon">Telepon</label>
                    <?php
                        //jika set value ada isinya maka value pada input form diisikan dengan nilai dari set value
                        //tapi jika kosong maka diisi dengan hasil dari query
                        if(strlen(set_value('telepon'))>0){
                          $ktp = set_value('telepon');
                        }
                    ?>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $telepon?>" placeholder="Diisi dengan Nomor Telepon (081321405677)">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" 
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" 
    crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" 
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" 
    crossorigin="anonymous">
    </script>

<script>
          function deleteConfirm(url){
              url2 = "<?= base_url('penghuni/listpenghuni') ?>"; //diisi dengan halaman ini
              
              var tomboldelete = document.getElementById('btn-delete')  
              tomboldelete.setAttribute("href", url); //akan meload kontroller delete

              var tomboldelete = document.getElementById('btn-batal')
              tomboldelete.setAttribute("href", url2); //akan meload halaman ini

              var tombolbatal = document.getElementById('btn-tutup')
              tombolbatal.setAttribute("href", url2); //akan meload halaman ini

              var pesan = "Data dengan ID <b>"
              var pesan2 = " </b>akan dihapus"
              var n = url.lastIndexOf("/")
              var res = url.substring(n+1);
              document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

              var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
              
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

<!-- Akhir Modals -->        


    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  
      <script>
            $(document).ready(function() {
                $('#example').DataTable(
                  {
                    //untuk memodifikasi list filter baris yang ditampilkan
                    "lengthMenu": [ 1, 5, 10, 20, 50, 100, 1000]
                  }  
                );
            } );
    </script>

    
  
  </body>
</html>
