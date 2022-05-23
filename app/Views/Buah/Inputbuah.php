<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Buah</h1>
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
      ?>
        <div class="row">
        <?= form_open('modul7') ?>
                <div class="mb-3">
                <label for="id_buah" class="form-label">Pilih Buah</label>
                    <select class="form-select" aria-label="Default select example" id="id_buah" name="id_buah" onchange="myFunction()">
                        <?php
                            //looping penghuni
                            foreach($buah as $row):
                                $id_buah = $row['IdBuah'];
                                $NamaBuah = $row['NamaBuah'];
                                $stok = $row['Stok'];
                                $harga = $row['Harga'];
                                if(set_value('id_buah')==$id_buah){
                                  ?>
                                    <option value="<?= $id_buah.'|'.$harga.'|'.$NamaBuah ?>" selected><?= $NamaBuah?></option>
                                  <?php
                                }else{
                                  ?>
                                    <option value="<?= $id_buah.'|'.$harga.'|'.$NamaBuah ?>"><?= $NamaBuah?></option>
                                  <?php
                                }
                            endforeach;
                        ?>
                    </select>
                </div>
                <div id="x"></div>

                <div class="mb-3">
                    <label for="notransaksi" class="form-label">No Transaksi</label>
                    <input type="text" class="form-control" id="notransaksi" name="notransaksi" value="<?= set_value('notransaksi')?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga / Kg</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?= set_value('harga')?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Transaksi</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= set_value('jumlah')?>" onchange="myFunction()">
                </div>
                <div class="mb-3">
                    <label for="hargatotal" class="form-label">Harga Total</label>
                    <input type="text" class="form-control" id="hargatotal" name="hargatotal" value="<?= set_value('hargatotal')?>" disabled>
                </div>
                <a class="btn btn-primary" href="#" role="button" onclick="tambahdata()">Tambah</a>
                <a class="btn btn-primary" href="#" role="button" onclick="selesai()">Selesai</a>
            </form>
        </div>
        <br>
        <div id="x2"></div>                        
    
     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

    <!-- Letak Javascript Untuk myFunction -->
    <script>
        //fungsi untuk genereate kuitansi
        function kuitansi(var_idbuah) { 
        //dapatkan tanggal sekarangf
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy+mm+dd;

        var hasil = 'FAK-'+today+'-'+var_idbuah;


        return hasil;
        }
      
        //untuk fungsi number format di javascript
        function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }


        //fungsi ini akan terpicu jika ada perubahan nilai pada elemen combo box 
        function myFunction(){
            //pilih elemen yang akan kita manipulasi atribut obyeknya
            var var_combobox = document.getElementById("id_buah"); 
            //harga adalah komponen pertama dari nilai idbuah ID|HARGA
            var myarr = var_combobox.value.split("|"); //formatnya adalah ID|HARGA

            var notransaksi = document.getElementById("notransaksi"); 
            var var_harga = document.getElementById('harga');
            var nokuitansi = kuitansi(myarr[0]); //index ke-0 adalah ID, index ke-1 adalah harga

            //isikan dengan nomer kuitansi pada elemen html
            notransaksi.setAttribute('value',nokuitansi);
            //isikan dengan nilai harga buah
            var_harga.setAttribute('value',number_format(myarr[1]));

            //get element harga
            var jumlah = document.getElementById("jumlah").value;
            var  hargatotal = document.getElementById("hargatotal");
            hargatotal.value = number_format(jumlah*myarr[1]); //jumlah dikali harga

            //document.getElementById("x").innerHTML = myarr[0];
        }

        //fungsi tambah data di bawah
        function tambahdata(){
            var totalharga = 0;
            var var_combobox = document.getElementById("id_buah"); 
            //harga adalah komponen pertama dari nilai idbuah ID|HARGA
            var myarr = var_combobox.value.split("|"); //formatnya adalah ID|HARGA

            teks = myarr[2]+" | "+document.getElementById("notransaksi").value;
            teks += " | "+document.getElementById("harga").value;
            teks += " | "+document.getElementById("jumlah").value;
            teks += " | "+document.getElementById("hargatotal").value;
            totalharga = totalharga + Number(document.getElementById("hargatotal").value.replace(/[^\d.-]/g, ''));
            teks += " | "+totalharga;
            var node = document.createElement("LI");
            var textnode = document.createTextNode(teks);
            node.appendChild(textnode);
            document.getElementById("x2").appendChild(node);
        }

        function selesai(){
            var totalharga = document.querySelectorAll("li");
            console.log(totalharga);
            //document.getElementById("x").innerHTML = totalharga[22].innerText;
            var i; var total = 0;
            for (i = 20; i < totalharga.length; i++) {
                var temp = totalharga[i].innerText.split("|")
                total = total + Number(temp[5])
            }
            var node = document.createElement("LI");
            teks = "Total = "+number_format(total)+"";
            var textnode = document.createTextNode(teks);
            node.appendChild(textnode);
            document.getElementById("x2").appendChild(node);
        }

    </script>

 
  </body>
</html>
