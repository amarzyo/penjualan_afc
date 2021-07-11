<?php 
// Memulai sesion
   session_start();

// Memeriksa jika belum login maka diarahkan ke halaman login
   if( !isset($_SESSION["login"]) ) {
     header("location: login.php");
    exit;
   }

// Menghubungkan ke file koneksi
   require 'koneksi.php';

// Membahkan Pelanggan
   if( isset($_POST["simpan"]) ) {
     if( tambah_pelanggan($_POST) > 0 ) {
       echo "<script>alert('User Accepted')</script>";
     } else{
       echo mysqli_error($conn);
     }
   }

// Edit Data
    if (isset ($_POST["edit_simpan"]) ) {
      if (edit_pelanggan($_POST) > 0 ){
         echo "
         <script>
           alert('Great!');
           document.location.href  = 'list_pelanggan.php';
         </script>
         ";
      }else{
         echo "
         <script>
           alert('Failed!');
           document.location.href  = 'list_pelanggan.php';
         </script>
         ";
      }
    }


// Ambil data dari tabel Database
   $pelanggan = query("SELECT * FROM pelanggan");

// Judul Halaman
   $page = 'List Customer';
?>
<!DOCTYPE html>
<html>
<head><?php require 'head.php'; ?></head>
<title><?php echo "$page"; ?></title>
<body class="belakang">
<!-- Navbar-->
  <?php require 'navbar_admin.php'; ?>
<!-- Daftar Pelanggan ------------------------------------->
    <div class="judul"></div>
    <div class="container">
      <div class="card border-0 shadow my-5 col-md-7 mx-auto">
        <div class="kotak card-body">
          <nav class="navbar navbar-light bg-light">
            <a class="btn btn-primary mb-2 ml-2" href="#tambah_pelanggan" data-toggle="modal"><i class="fas fa-plus" aria-hidden="true"></i> Customer!</a>
            <form class="form-inline">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            </form>
          </nav>        
          <table class="tabel text-center text-uppercase table-responsive-lg">
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>No HP</th>
              <th>Alamat</th>
              <th>Edit / Delete</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ( $pelanggan as $row ) :  ?>
            <tr>
               <td><?= $no;?></td>
               <td><?= $row['nama']; ?></td>
               <td><?= $row['no_hp']; ?></td>
               <td><?= $row['alamat']; ?></td>
               <td>
                <a href="#" data-toggle="modal" data-target="#edit<?= $row['id_pelanggan']?>" class="btn btn-sm btn-primary mr-2" role="button"><i class="fa fa-pen" aria-hidden="true"></i></a>
                <a href="delete_pelanggan.php?id=<?= $row["id_pelanggan"]; ?>" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger mr-2" role="button"><i class="fas fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
            <?php $no++ ?>
            <?php endforeach; ?>
         </table>
        </div>
      </div>
    </div>
<!-- Modal Tambah Pelanggan ------------------------------->
    <div class="portfolio-modal modal fade" id="tambah_pelanggan" tabindex="-1" role="dialog" aria-labelledby="tambah_pelanggan" aria-hidden="true">
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
                    <h2>Tambahkan pelanggan?</h2>
                    <hr class="my">
                    <input type="text" class="form-control mt-2" name="nama" id="nama" placeholder="Nama" required>
                    <input type="text" class="form-control mt-2" name="no_hp" id="no_hp" placeholder="No Hp" required>
                    <textarea type="text" class="form-control mt-2" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                    <button type="submit" name="simpan" id="simpan" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Simpan!</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- Modal Edit Pelanggan --------------------------------->
    <?php foreach ( $pelanggan as $row ) :  ?>
    <div class="portfolio-modal modal fade" id="edit<?= $row['id_pelanggan']?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $row['id_pelanggan']?>" aria-hidden="true">
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
                    <h2>Edit Pelanggan?</h2>
                    <hr class="my">
                    <input type="hidden" class="form-control mt-2" name="edit_id" id="edit_id" value="<?= $row['id_pelanggan'];?> ">
                    <input type="text" class="form-control mt-2" name="edit_nama" id="edit_nama" placeholder="Nama" value="<?= $row['nama'];?>" required>
                    <input type="text" class="form-control mt-2" name="edit_no_hp" id="edit_no_hp" placeholder="No Hp" value="<?= $row['no_hp'];?>" required>
                    <textarea type="text" class="form-control mt-2" name="edit_alamat" id="edit_alamat" placeholder="Alamat" required><?= $row['alamat'];?></textarea>
                    <button type="submit" name="edit_simpan" id="edit_simpan" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Simpan!</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
<!-- Footer -->
  <?php require 'footer.php'; ?>
<!--- JQuery -->
  <script src="js/jquery-3.5.1.js"></script> 
  <script src="js/popper.js"></script> 
  <script src="js/bootstrap.js"></script>
  <script src="js/scripts.js"></script>
</body>
</html>