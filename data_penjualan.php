<?php 

	// Nama Halaman
		$page = 'List Buy';
		$menu = 'Buy';

?>

<!DOCTYPE html>
<html>
<head>
	<?php require 'head.php'; ?>
	<title>List Buy - AFComputer</title>
</head>
<body class="belakang">
<!-- NAVBAR -->
	<?php require 'navbar_admin.php'; ?>
<!-- KONTEN -->
    <div class="container" style="margin-top: 100px;">
      <div class="card border-0 shadow my-3">
        <div class="card-body table-resposive">
          <?php require 'navbar_order.php'; ?>
          <nav class="navbar navbar-dark bg-dark mt-2">
            <a class="btn btn-success" href="#tambah" data-toggle="modal"><i class="fas fa-plus" aria-hidden="true"></i> Add</a>
            <form class="form-inline" action="" method="POST">
              <input class="form-control mr-2" type="search" id="keyword" name="keyword" size="40" placeholder="Pencarian..." autocomplete="off" autofocus>
              <button type="submit" name="tombol-cari" id="tombol-cari" class="btn btn-xlg btn-success"><i class="fas fa-search fa-fw"></i></button>
            </form>
          </nav> 
          <table class="tabel table-sm text-center table-responsive-sm mt-2">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Service</th>
              <th>Total</th>
              <th>Status</th>
              <th>Info / Edit / Delete / Print</th>
            </tr>
            <tr>
            </tr>
           </table>
        </div>
      </div>
    </div>
</body>
</html>