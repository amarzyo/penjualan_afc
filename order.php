<?php
  // Mengubungkan ke file koneksi 
    require 'koneksi.php';

  // Query tabel Orderan
    $orderan = query("SELECT * FROM orderan");


	// Nama Halaman
		$page = 'Order';

?>

<!DOCTYPE html>
<html>
<head>
	<?php require 'head.php'; ?>
	<title><?= $page; ?> - AFComputer</title>
</head>
<body class="belakang">
<!-- NAVBAR -->
	<?php require 'navbar_admin.php'; ?>
<!-- KONTEN -->
    <div class="container" style="margin-top: 100px;">
      <div class="card border-0 shadow my-3">
        <div class="card-body">
          <!-- Nomer -->
          <div class="row">
            <div class="col-sm-12 col-md-7">
              <img src="img/AFComp.png" class="rounded mx-auto d-block mb-2" width="100%">
            </div>
            <div class="col-sm-12 col-md-5">
              <label class="mb-1 ml-1">Nomer Invoice:</label><!DOCTYPE html>
              <html>
              <head>
                <title><!DOCTYPE html>
                <html>
                <head>
                  <title></title>
                </head>
                <body>
                
                </body>
                </html></title>
              </head>
              <body>
              
              </body>
              </html>
              <input type="text" name="nomer" class="form-control mb-2" value="<?= date('dm') ?> - <?= count($orderan)+1; ?>" readonly>
              <label class="mb-1 ml-1">Hari, Tanggal:</label>
              <input type="text" name="tgl" class="form-control mb-2" value="<?= date('D, d-m-Y') ?>" readonly>
              <label class="mb-1 ml-1">Nama Pelanggan:</label>
              <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?=  ?>">
              <div class="dropdown mt-2">
                <button class="btn btn-xlg btn-success dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <strong>Tambah Order</strong>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#service" data-toggle="modal">Service</a>
                  <a class="dropdown-item" href="#pembelian" data-toggle="modal">Printing</a>
                  <a class="dropdown-item" href="#printing" data-toggle="modal">Pembelian</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Daftar Orderan -->
          <table class="table table-xlg table-resposive text-uppercase text-center mt-3">
            <thead>
              <tr>
                <th class="align-middle">No</th>
                <th class="align-middle">Nama Transaksi</th>
                <th class="align-middle">Harga</th>
                <th class="align-middle">Qty</th>
                <th class="align-middle">Jumlah</th>
                <th class="align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ( $orderan as $order ) : ?>
                <tr>
                  <td class="align-middle"><?= $no; ?></td>
                  <td class="align-middle"><?= $order["nama_transaksi"]; ?></td>
                  <td class="align-middle">Rp. <?= number_format($order["harga"]); ?></td>
                  <td class="align-middle"><?= $order["qty"]; ?></td>
                  <td class="align-middle">Rp. <?= number_format($order["jumlah"]); ?></td>
                  <td class="align-middle">
                    <a href="edit_barang.php?gbr=<?= $row["gambar"]; ?>" data-toggle="modal" data-target="#edit<?= $row['kode']?>" class="btn btn-sm btn-primary mt-2" role="button"><i class="fa fa-pen" aria-hidden="true"></i></a>
                    <a href="delete_barang.php?id=<?= $row["kode"]; ?>&gbr=<?= $row["gambar"]; ?>" class="btn btn-sm btn-danger mt-2" role="button" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a>
                  </td>
                </tr>
                <?php $no++ ?>
                <?php endforeach; ?>
              </tbody>
          </table>
          <div class="row text-center">
            <div class="col-3">
              <label><strong>AFComputer</strong></label>
            </div>
            <div class="col-5">
              <label><strong>Catatan</strong></label>
            </div>
            <div class="col-4">
              <label><strong>Total</strong></label>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-3">
              <br>
              <br>
              <br>
              <label>(  .  .  .  .  .  .  .  . ) </label>
            </div>
            <div class="col-5 text-left">
              <label>
                - Harap Perikas Barang setelah diterima<br>
                - Pengambilan barang maksimal 2 bulan terhitung dari waktu konfirmasi<br>
                - Barang yang sudah dibeli tidak dapat dikembalikan/ditukar<br>
                &ensp; Garansi:  &ensp;  &ensp;  &ensp;  &ensp;  &ensp;  &ensp; hari/minggu/bulan<br>
            </div>
            <div class="col-4">
              <?php $total = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(jumlah) AS 'totals' FROM orderan")); ?>
              <h5>Rp. <?= number_format($total['totals']); ?></h5>
            </div>
          </div>
          <center>
            <br>
            <strong>TERIMAKASIH ATAS KEPERCAYAAN ANDA</strong></label> <br>
            <label>AFComputer | Jl. Tugu Barat, Sampang | <i class="fab fa-whatsapp ml-2 mr-2"></i><a href="https://wa.me/+6285742166695?text=Kak Saya Mau Tanya %0A">085742166695</a></label>
          </center>
        </div>
      </div>
    </div>
<!-- MODAL SERVICE-->
    <div class="portfolio-modal modal fade" id="service" tabindex="-1" role="dialog" aria-labelledby="service" aria-hidden="true">
        <div class="modal-dialog modal-xlg" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="container">
                      <div class="row ">
                        <div class="col">
                          <h2 class="text-center">Tambahkan Sesuatu?</h2>
                          <hr class="my">
                          <input type="text" class="form-control" name="namaBarang" placeholder="Nama Barang">
                          <textarea class="form-control mt-2" name="keterangan" placeholder="Keterangan"></textarea>
                          <input type="text" class="form-control mt-2" name="harga" placeholder="Harga">
                          <input type="number" class="form-control mt-2" name="garansi" placeholder="Garansi">
                          <button type="submit" name="simpan_barang" class="btn btn-sm btn-primary btn-block text-uppercase mt-2"><i class="fas fa-plus fa-fw"></i>Tambahkan!</button>                          
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
<?php require 'jquery.php'; ?>
</body>
</html>