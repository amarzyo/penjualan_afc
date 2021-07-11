<?php 
  // Memulai sesion
  session_start();

  // Memeriksa jika belum login maka diarahkan ke halaman login
    if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
  }

  // Menghubungkan ke file koneksi
  require "koneksi.php";

  // Ketika tombol TAMBAH di MODAL di klik
    if( isset($_POST["tambah_servis"]) ) {

      //Cek data berhasil masuk atau tidak
      if( tambah_servis($_POST) > 0) {
        echo "<script>alert('Good!')</script>";
      }exit;
    }

    // Ambil data dari database
    $servis = query("SELECT * FROM servis");


  // Judul Halaman
  $page = 'List Order';
  // Judul Menu
  $menu = 'Service'; ?>

<!DOCTYPE html>
<html lang="en">
    <head><?php require 'head.php'; ?></head>
    <title><?= "$page"; ?></title>
    <body class="belakang">
<!----- Navbar------------------->
      <?php require 'navbar_admin.php'; ?>
<!----- Content------------------>
        <div class="container" style="margin-top: 100px;">
          <div class="card border-0 shadow my-3">
            <div class="card-body table-resposive">
              <?php require 'navbar_order.php'; ?>
              <nav class="navbar navbar-dark bg-dark mt-2">
                <a class="btn btn-sm btn-success" href="#tambah" data-toggle="modal"><i class="fas fa-plus" aria-hidden="true"></i> Add</a>
                <form class="form-inline" action="" method="POST">
                  <input class="form-control mr-2" type="search" id="keyword" name="keyword" size="40" placeholder="Pencarian..." autocomplete="off" autofocus>
                  <button type="submit" name="tombol-cari" id="tombol-cari" class="btn btn-xlg btn-success"><i class="fas fa-search fa-fw"></i></button>
                </form>
              </nav> 
              <table class="tabel table-sm table-responsive-sm mt-2">
                <thead>
                  <tr>
                    <th align="left">No</th>
                    <th align="left">Invoice</th>
                    <th align="left">Nama</th>
                    <th align="left">Keterangan</th>
                    <th align="left">Status Servis</th>
                    <th align="left">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td width="100">29421-1</td>
                    <td width="150">Witri Amaliatur Rumamah</td>
                    <td>Asus x453m Matot</td>
                    <td width="100" class="table-success">Selesai</td>
                    <td width="100">                      
                      <a href="#" data-toggle="modal" data-target="#info<?= $row['kode']?>" class="btn btn-sm btn-info" role="button"><i class="fa fa-info" aria-hidden="true"></i></a>
                      <a href="edit_barang.php?gbr=<?= $row["gambar"]; ?>" data-toggle="modal" data-target="#edit<?= $row['kode']?>" class="btn btn-sm btn-primary" role="button"><i class="fa fa-pen" aria-hidden="true"></i></a>
                      <a href="delete_barang.php?id=<?= $row["kode"]; ?>&gbr=<?= $row["gambar"]; ?>" class="btn btn-sm btn-danger" role="button" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                </tbody>
               </table>
            </div>
          </div>
        </div>
<!----- MODAL TAMBAH SERVICE ---->
        <div class="portfolio-modal modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
          <div class="modal-dialog modal-xlg" role="document">
            <div class="modal-content">
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
              <div class="modal-body text-center">
                <form action="" method="POST">
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col">
                        <h2>Add Service?</h2>
                        <hr class="my">
                        <input type="text" class="form-control mt-2" name="tgl" id="tgl" value="<?= date('l, d-m-Y') ?>" readonly>
                        <input type="text" class="form-control mt-2" name="nama" id="nama" placeholder="Nama">
                        <textarea class="mt-2 form-control" name="servise" id="servise" placeholder="Service"></textarea>
                        <input type="text" class="form-control mt-2" name="qty" id="qty" placeholder="Quantity">
                        <input type="text" class="form-control mt-2" name="harga" id="harga" placeholder="Harga">
                        <input type="text" class="form-control mt-2" name="garansi" id="garansi" placeholder="Warranty">
                        <button type="submit" name="tambah_servis" id="tambah_servis" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Save</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
<!----- MODAL INFO -------------->
        <div class="portfolio-modal modal fade" id="info<?= $row['kode'];?>" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
                  <div class="modal-body text-center">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col">
                          <h2>Info Produk</h2>
                          <hr class="my">
                          <div class="container">
                            <div class="row">
                              <div class="col-4">
                                <img src="img/barang/<?= $row['gambar'];?>" width="240px" height="240px">
                              </div>
                              <div class="col-8">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-3 text-left">
                                      <label style="font-family: cambria; font-size: 14px">Nama</label> <br>
                                      <label style="font-family: cambria; font-size: 14px">Kategori</label> <br>
                                      <label style="font-family: cambria; font-size: 14px">Waktu Masuk</label> <br>
                                      <label style="font-family: cambria; font-size: 14px">Kondisi</label> <br>
                                      <label style="font-family: cambria; font-size: 14px">Sisa Stok</label> <br>                              
                                      <label style="font-family: cambria; font-size: 14px">Harga Beli</label> <br>
                                      <label style="font-family: cambria; font-size: 14px">Harga Jual</label> <br>
                                      <label style="font-family: cambria; font-size: 14px">Keterangan</label>
                                    </div>
                                    <div class="col-9 text-left">
                                      <label style="font-family: cambria; font-size: 14px">: <?= $row["nama"]; ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: <?= strtoupper($row["kategori"]); ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: <?= $row["waktu"]; ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: <?= $row["kondisi"]; ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: <?= $row["stok"]; ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: Rp. <?= number_format($row["harga_beli"]); ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: Rp. <?= number_format($row["harga_jual"]); ?></label> <br>
                                      <label style="font-family: cambria; font-size: 14px">: <?= $row["keterangan"]; ?></label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!-- Footer ------------------> 
      <?php require 'footer.php'; ?>
<!---JQuery ------------------>
      <?php require 'jquery.php'; ?>
  </body>
</html>