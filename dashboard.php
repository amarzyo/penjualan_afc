<?php 
  // Memulai sesion
    session_start();

  // Memeriksa Session
      if( !isset($_SESSION["login"]) ) {
      header("location: login.php");
      exit;
    }

  // menghubungkan ke file koneksi
    require "koneksi.php";


  // Ketika tombol TAMBAH di MODAL di klik
      if( isset($_POST["simpan_barang"]) ) {
        if (tambah_barang($_POST) > 0) {
            echo "<script>alert('BERHASIL')</script>";
        } else{
            echo "<script>alert('GAGAL')</script>";
          }
      }

  // Menambah Kategori
      if (isset ($_POST["simpan_kategori"]) ) {
        if (tambah_kategori($_POST) > 0 ){
            echo "<script>alert('BERHASIL')</script>";
        } else{
            echo "<script>alert('GAGAL')</script>";
          }
      }

  // Mengedit Barang
      if (isset ($_POST["edit_data"]) ) {
        if (edit_barang($_POST) > 0 ){
            echo "<script>alert('BERHASIL')</script>";
        } else{
            echo "<script>alert('GAGAL')</script>";
          }
      }

  // Mengambil Data dari Database
       $barang    = query("SELECT * FROM barang ORDER BY nama ASC");
       $kategori  = query("SELECT * FROM kategori");

  // Judul Halaman
       $page = 'Dashboard'; ?>

<!DOCTYPE html>
<html lang="en">
    <head><?php require 'head.php'; ?></head>
    <title>AFComputer - <?= "$page"; ?></title>
    <body class="belakang">
<!-- Navbar-->
    <?php require 'navbar_admin.php'; ?>
<!-- CONTENT ---------------->
        <div class="judul"></div>
        <div class="container">
          <div class="card border-0 shadow my-3">
            <div class="kotak card-body">
                <div class="row mb-3">
                  <div class="col-sm-12 col-md-6">
                    <a class="btn btn-primary btn-xlg ml-2" href="#tambah" data-toggle="modal"><i class="fas fa-plus" aria-hidden="true"></i> Produk</a>
                    <a class="btn btn-primary btn-xlg ml-2" href="#kategori" data-toggle="modal"><i class="fas fa-plus" aria-hidden="true"></i> Kategori</a>
                    <a class="btn btn-primary btn-xlg ml-2" href="print.php" target="_BLANK"><i class="fas fa-print" aria-hidden="true"></i> Print PDF</a>
                  </div>
                </div>
              <div id="container">
                <table class="tabel table-sm table-resposive text-uppercase text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Harga</th>
                      <th width="100px">Edit / Delete</th>
                      </tr>
                  </thead>
                  <?php $no = 1; ?>
                  <?php foreach ( $barang as $row ) :  ?>
                  <tbody>
                    <tr>
                      <td><?= $no;?></td>
                      <td><?= strtoupper($row["kategori"]); ?> - <?= $row["kode"];?></td>
                      <td><img src="img/barang/<?= $row["gambar"]; ?>" width="auto" height="50x"></td>
                      <td><?= $row["nama"];?></td>
                      <td>Rp. <?= number_format($row["harga_jual"]);?></td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#info<?= $row['kode']?>" class="btn btn-sm btn-info" role="button"><i class="fa fa-info" aria-hidden="true"></i></a>
                        <a href="edit_barang.php?gbr=<?= $row["gambar"]; ?>" data-toggle="modal" data-target="#edit<?= $row['kode']?>" class="btn btn-sm btn-primary" role="button"><i class="fa fa-pen" aria-hidden="true"></i></a>
                        <a href="delete_barang.php?id=<?= $row["kode"]; ?>&gbr=<?= $row["gambar"]; ?>" class="btn btn-sm btn-danger" role="button" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  </tbody>
                  <?php $no++ ?>
                  <?php endforeach; ?>
                </table>
              </div>
            </div>
          </div>
        </div> 
<!-- MODAL Tambah Barang ---->
    <div class="portfolio-modal modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
        <div class="modal-dialog modal-xlg" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col">
                          <h2>Tambahkan Sesuatu?</h2>
                          <hr class="my">
                          <input type="text" class="form-control mt-2" name="waktu" value="<?= date('l, d-m-Y') ?>" readonly>
                          <select class="custom-select mt-2" name="kategori">
                            <?php foreach ( $kategori as $kat ) : ?>
                            <option value="<?= $kat["singkatan"]; ?>"><?= ucwords($kat["kategori"]); ?></option>
                            <?php endforeach; ?>
                          </select>
                          <input type="text" class="form-control mt-2" name="nama" placeholder="Nama" required>
                          <select class="custom-select mt-2" name="kondisi">
                            <option value="Baru">Baru</option>
                            <option value="Bekas">Bekas</option>
                          </select>
                          <input type="number" class="form-control mt-2" name="stok" placeholder="Stok">
                          <input type="text" class="form-control mt-2" name="ukuran" placeholder="Ukuran">  
                          <input type="number" class="form-control mt-2" name="harga_beli" placeholder="Harga Beli" required>
                          <input type="number" class="form-control mt-2" name="harga_jual" placeholder="Harga Jual" required>
                          <input type="file" class="form-control-file mt-2" name="gambar" required>                        
                          <textarea class="mt-2 form-control" name="keterangan" required></textarea>
                          <button type="submit" name="simpan_barang" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Tambahkan!</button>                          
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
<!-- MODAL Tambah Kategori -->
    <div class="portfolio-modal modal fade" id="kategori" tabindex="-1" role="dialog" aria-labelledby="kategori" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                  <form action="" method="POST">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col">
                          <h2>Tambah Kategori?</h2>
                          <hr class="my">
                          <input type="text" class="form-control mt-2" name="tambah_kategori" placeholder="Kategori" required>
                          <input type="text" class="form-control mt-2" name="tambah_singkatan_kategori" maxlength="3" placeholder="Singkatan" required>
                          <button type="submit" name="simpan_kategori" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Simpan</button>
                          <h5 class="mt-2">Daftar Kategori</h5>
                          <table class="tabel table-sm text-uppercase table-responsive-lg">
                            <tr>
                              <th class="text-left">No</th>
                              <th class="text-left">Kategori</th>
                              <th>Delete</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php foreach ( $kategori as $kat ) :  ?>
                            <tr>
                              <td class="text-left"><?= $no;?></td>
                              <td class="text-left"><?= $kat["kategori"];?></td>
                              <td>
                                <a href="delete_kategori.php?id=<?= $kat["id_kategori"]; ?>" class="btn btn-sm btn-danger" role="button" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                            <?php $no++ ?>
                            <?php endforeach; ?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
<!-- MODAL Edit Barang ------>
    <?php foreach ( $barang as $row ) :  ?>
    <div class="portfolio-modal modal fade" id="edit<?= $row['kode'];?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog modal-xlg" role="document">
        <div class="modal-content">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times"></i></span>
          </button>
          <div class="modal-body text-center">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col">
                    <h2>Edit Sesuatu?</h2>
                    <hr class="my">
                    <img src="img/barang/<?= $row['gambar'];?>" width="auto" height="120px">
                    <input type="hidden" class="form-control mt-2" name="edit_id" value="<?= $row['kode']; ?>">
                    <input type="hidden" class="form-control mt-2" name="edit_gambar_lama" value="<?= $row['gambar']; ?>">
                    <select class="custom-select mt-2" name="edit_kategori">
                      <?php foreach ( $kategori as $kat ) : ?>
                      <option value="<?= $kat["singkatan"]; ?>"><?= ucwords($kat["kategori"]); ?></option>
                      <?php endforeach; ?>
                    </select>
                    <input type="text" class="form-control mt-2" name="edit_nama" value="<?= $row['nama']; ?>">
                    <select class="custom-select mt-2" name="edit_kondisi">
                      <option value="Baru">Baru</option>
                      <option value="Bekas">Bekas</option>
                    </select>
                    <input type="number" class="form-control mt-2" name="edit_stok" value="<?= $row['stok']; ?>">
                    <input type="text" class="form-control mt-2" name="edit_ukuran" value="<?= $row['ukuran']; ?>">
                    <input type="number" class="form-control mt-2" name="edit_harga_beli" value="<?= $row['harga_beli']; ?>">  
                    <input type="number" class="form-control mt-2" name="edit_harga_jual" value="<?= $row['harga_jual']; ?>">                       
                    <input type="file" class="form-control-file mt-2" name="edit_gambar_baru">
                    <textarea class="mt-2 form-control" name="edit_keterangan"><?= $row['keterangan']; ?></textarea>
                    <button type="submit" name="edit_data" class="btn btn-sm btn-primary float-right text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Simpan!</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
<!-- MODAL Info ------------->
    <?php foreach ( $barang as $row ) :  ?>
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
    <?php endforeach; ?>
<!-- FOOTER -----------------> 
    <?php require 'footer.php'; ?> 
<!-- JQuery ----------------->
    <?php require 'jquery.php'; ?>
  </body>
</html>