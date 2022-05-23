<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

        
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span data-feather="database"></span>
                  Master Data
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              
                      
                      <li><a class="dropdown-item" href="<?= base_url('coa') ?>">COA</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('customer') ?>">Customer</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('mainan') ?>">Mainan</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('vendor') ?>">Vendor</a></li>
                      
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                   </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span data-feather="shopping-cart"></span>
                    Transaksi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('pembelian') ?>">Pembelian</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('CPenjualan/PenjualanView') ?>">Penjualan</a></li>
                      <!-- <li><a class="dropdown-item" href="<?= base_url('pemesanan') ?>">Pemesanan</a></li> -->
                      <!-- <li><a class="dropdown-item" href="<?= base_url('pembayaran') ?>">Pembayaran</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('pemesanan/perubahan') ?>">Perubahan Status</a></li> -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span data-feather="clipboard"></span>
                    Laporan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="<?= base_url('laporan/Jurnal') ?>">Jurnal Umum</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('laporan/BukuBesar') ?>">Buku Besar</a></li>
                      <!-- <li><a class="dropdown-item" href="<?= base_url('JurnalController') ?>">Rincian Pemesanan</a></li> -->
                      <li><a class="dropdown-item" href="<?= base_url('Laporanpemesanan/LaporanPenjualan') ?>">Laporan Penjualan</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('pemesanan/lihat_pembayaran') ?>">Laporan Pembayaran</a></li>
                      <!-- <li><a class="dropdown-item" href="<?= base_url('laporan/labarugi') ?>">Laba Rugi</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('laporan/lihatlaporanpemesanan') ?>">Laporan Pemesanan</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('laporan/DaftarCustomer') ?>">Pembayaran</a></li> -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span data-feather="bar-chart-2"></span>
                    Grafik
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('grafik') ?>">Line</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('grafik/tren_pemesanan') ?>">Tren Pemesanan</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('grafik/okupansi_kamar') ?>">Okupansi Kamar</a></li>
                  </ul>
                </li>
          
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="layers"></span>
                      Analisis Data
                    </a>
                  </li>

          
        </ul>

       
      </div>
    </nav>