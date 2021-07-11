<?php
  // Memulai sesion
  // session_start();

  // Memeriksa jika belum login maka diarahkan ke halaman login
  //  if( !isset($_SESSION["login"]) ) {
  //  header("location: login.php");
  //  exit;
  //  }

  // Menghubungkan ke file koneksi
    require 'koneksi.php';

  // Ketika tombol Simpan di klik
    if( isset($_POST["simpan_user"]) ) {
      if( tambah_user($_POST) > 0 ) {
        echo "<script>alert('BERHASIL')</script>";
      } else{
        echo "<script>alert('GAGAL')</script>";
      }
    }

  // Ambil data dari tabel Database
  $user = query("SELECT * FROM user");

  // Judul Halaman
  $page = "User & Register"; ?>

<!DOCTYPE html>
<html>
<head><?php require 'head.php'; ?></head>
<title><?= "$page"; ?></title>
<body class="belakang">
<!----------------------------- NAVBAR -------------------->
  <?php require 'navbar_admin.php'; ?>
<!----------------------------- CONTENT  ------------------->
  <div class="judul"></div>
  <div class="container">
    <div class="card col-md-8 mx-auto border-0 shadow my-3">
      <div class="kotak card-body table-resposive">
        <nav class="navbar mb-2">
          <div class="col">
            <div class="row">
              <a class="btn btn-primary btn-sm ml-2" href="#tambah" data-toggle="modal"><i class="fas fa-plus" aria-hidden="true"></i> Users</a>
            </div>
          </div>
          <form class="form-inline" action="" method="POST">
            <img src="img/loader.gif" width="20px" height="20px" id="loader" style="display: none;">
            <input class="form-control input-sm mr-2" type="text" id="keyword" name="keyword" size="50" placeholder="Pencarian..." autocomplete="off" autofocus>
            <button type="submit" name="tombol-cari" id="tombol-cari" class="btn btn-xlg btn-primary"><i class="fas fa-search fa-fw"></i></button>
          </form>
        </nav>
        <div id="container">
          <table class="tabel table-sm text-uppercase table-responsive-sm">
            <tr>
              <th class="text-center" width="10">No</th>
              <th class="text-center" width="50">Foto</th>
              <th class="text-center" width="150">Nama</th>
              <th class="text-center" width="150">No HP</th>
              <th class="text-center" width="150">Level</th>
              <th>Edit / Delete</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ( $user as $row ) : ?>
            <tr>
              <td><?= $no; ?></td>
              <td><img src="img/user/<?= $row["foto"]; ?>" widht="auto" height="50"></td>
              <td><?= $row["nama"]; ?></td>
              <td><?= $row["telp"]; ?></td>
              <td><?= $row["level"]; ?></td>
              <td>
                <a href="#" data-toggle="modal" data-target="#edit<?= $row["id_user"]?>" class="btn btn-sm btn-primary" role="button"><i class="fa fa-pen" aria-hidden="true"></i></a>
                <a href="delete_user.php?id=<?= $row["id_user"]; ?>" class="btn btn-sm btn-danger" role="button" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
            <?php $no++ ?>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
<!----------------------------- MODAL Tambah USER ---------->
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
                          <h2>Tambah Pengguna?</h2>
                          <hr class="my">
                          <input type="text" class="form-control mt-2" name="nama" placeholder="Nama Lengkap" required>
                          <input type="text" class="form-control mt-2" name="no_hp" placeholder="No HP" required>
                          <input type="text" class="form-control mt-2" name="username" placeholder="username" required>
                          <input type="password" class="form-control mt-2" name="password" placeholder="Password" required>
                          <input type="password" class="form-control mt-2" name="password2" placeholder="Konfirmasi Password" required>
                          <select class="custom-select mt-2" name="level">
                            <option value="Administrator">Administrator</option>
                            <option value="Customer Service">Customer Service</option>
                          </select>
                          <input type="file" class="form-control-file mt-2" name="foto" required>
                          <button type="submit" name="simpan_user" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Simpan</button>                          
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
<!----------------------------- MODAL Edit USER ------------>
    <?php foreach ( $user as $row ) : ?>
    <div class="portfolio-modal modal fade" id="edit<?= $row["id_user"];?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
                      <h2>Edit Pengguna?</h2>
                      <hr class="my">
                      <img src="img/user/<?= $row['foto'];?>" width="auto" height="120px">
                      <input type="hidden" class="form-control mt-2" name="edit_id" value="<?= $row['id_user']; ?>">
                      <input type="text" class="form-control mt-2" name="edit_nama" placeholder="Nama Lengkap" value="<?= $row["nama"] ?>" required>
                      <input type="text" class="form-control mt-2" name="edit_no_hp" placeholder="No HP" value="<?= $row["telp"] ?>" required>
                      <input type="text" class="form-control mt-2" name="edit_username" placeholder="username" value="<?= $row["level"] ?>" required>
                      <input type="password" class="form-control mt-2" name="edit_password1" placeholder="Password Lama" required>
                      <input type="password" class="form-control mt-2" name="edit_password2" placeholder="Password Baru" required>
                      <input type="password" class="form-control mt-2" name="edit_password3" placeholder="Konfirmasi Password Baru" required>
                      <select class="custom-select mt-2" name="edit_level">
                        <option value="Administrator">Administrator</option>
                        <option value="Customer Service">Customer Service</option>
                      </select>
                      <input type="file" class="form-control-file mt-2" name="foto" required>
                      <button type="submit" name="edit_user" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Simpan</button>                          
                    </div>
                  </div>
                </div>
              </form>                          
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
<!----------------------------- FOOTER  ------------------->
  <?php require 'footer.php';  ?>
<!----------------------------- JQuery  ------------------->
  <?php require 'jquery.php'; ?>
</body>
</html>