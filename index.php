<?php
	// Menghubungkan ke file koneksi
		require 'koneksi.php';

	// Ambil data dari tabel barang
		$barang = query("SELECT * FROM barang");

	// Order Barang
	

	// Proses Eksekusi data
	  if( isset($_GET["order_simpan"]) ) {
	  	// Ambil data tiap elemen dalam form
			$order_nama 		= $_GET["order_nama"];
			$order_jumlah 		= $_GET["order_jumlah"];
			$order_namamu		= $_GET["order_namamu"];
			$order_alamatmu		= $_GET["order_alamatmu"];
			$order_anter_ambil	= $_GET["order_anter_ambil"];
			$order_bayar		= $_GET["order_bayar"];
			$enter				= '%0A';

	    	header("location:https://wa.me/+6285742166695?text=Assalamu'alaikum kak AFComputer, Perkenalkan $enter Namaku $order_namamu $enter Alamat $order_alamatmu $enter Ku mau $order_nama $enter $order_anter_ambil $enter Banyarnya $order_bayar $enter Ok kak?");
	  }
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="icon" type="image/x-icon" href="img/logo.png">
		<!-- Font Awesome icons (free version)-->
		<script src="js/fontawesome.js"></script>
		<!-- My CSS -->
		<link href="css/style-navbar.css" rel="stylesheet">
		<link href="css/style-index.css" rel="stylesheet">
    <title>AFComputer</title>
    <body>
<!-- Navbar -------->
	<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
	    <div class="container">
	    	<a class="judul navbar-brand js-scroll-trigger" href="index.php"><i class="fas fa-laptop-code mr-2"></i></i>AFComputer | <small>Computer Service & Printing</small></a>
	        <button class="navbar-toggler navbar-toggler-right font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
	        <div class="collapse navbar-collapse" id="navbarResponsive">
	            <ul class="navmenu-1 navbar-nav ml-auto">
	                <a class="btn btn-sm btn-info bi bi-display mr-2 mt-2" href="dashboard.php"><i class="fas fa-home" aria-hidden="true"></i> Dashboard</a>
	                <a class="btn btn-sm btn-success bi bi-display mr-2 mt-2" href="https://wa.me/+6285742166695?text=Assalamu'alaikum kak"><i class="fab fa-whatsapp" aria-hidden="true"></i> Chat via Whatsapp</a>
	            </ul>
	        </div>
	    </div>
	</nav>
<!-- PRODUK -------->
	<h1 class="produk text-center">PRODUK KAMI</h1>
	<div class="container">
		<div class="row">
			<?php foreach ($barang as $brg ) : ?>
			<div class="col-md-3 col-sm-12">
				<div class="card card-sm text-center bg-light mx-auto mr-2 mb-3">
					<a href="" data-toggle="modal" data-target="#info<?= $brg['kode']?>" role="button">
						<img class="card-img-top" title="Detail <?= $brg['nama']; ?>" src="img/barang/<?= $brg["gambar"]; ?>" alt="Card image cap">
					</a>
					<div class="card-body">
						<h4 class="card-title text-center"><?= $brg["nama"]; ?></h4>
						<h5 class="card-title text-center">Rp. <?= number_format($brg["harga_jual"]); ?></h5>
						<p class="card-text"><?= $brg["keterangan"]; ?></p>
						<p class="card-text"><strong>Kategori : </strong> <?= $brg["kategori"]; ?> <strong>| Stok :</strong> <?= $brg["stok"]; ?> Pcs <strong>| Kondisi :</strong> <?= $brg['kondisi']; ?></p>
					</div>
					<div class="card-footer">
						<a href="?id=<?= $brg['kode']; ?>" class="btn btn-xlg btn-block btn-success" data-toggle="modal" data-target="#order<?= $brg['kode']?>" role="button"><i class="fab fa-whatsapp mr-2"></i>Beli</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
<!-- MODAL PRODUK -->
	<?php foreach ($barang as $brg ) :?>
	<div class="portfolio-modal modal fade" id="info<?= $brg['kode']?>" tabindex="-1" role="dialog" aria-labelledby="info<?= $brg['kode']?>" aria-hidden="true">
        <div class="modal-dialog modal-xlg" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                     	<div class="row justify-content-center">
                        	<div class="col">
                         		<h3><?= $brg['nama']; ?></h3>
                         		<hr class="my">
                         		<div class="row">
                         			<div class="col">
                          				<img src="img/barang/<?= $brg['gambar']; ?>" width="80%" height="100%">
                          			</div>
                          		</div>
                          		<div class="row text-left">
                          			<div class="col-3">
                          				<h5>Kondisi</h5>
                          			</div>
                          			<div class="col-8">
                          				<label>: <?= $brg['kondisi']; ?></label>
                          			</div>
                          		</div>
                          		<div class="row text-left">
                          			<div class="col-3">
                          				<h5>Stok</h5>
                          			</div>
                          			<div class="col-8">
                          				<label>: <?= $brg['stok']; ?></label>
                          			</div>
                          		</div>
                          		<div class="row text-left">
                          			<div class="col-3">
                          				<h5>Harga</h5>
                          			</div>
                          			<div class="col-8">
                          				<label>: <?= $brg['harga_jual']; ?></label>
                          			</div>
                          		</div>
                          		<hr class="my">
                          		<h5 class="mt-2">Deskripsi</h5>
                          		<label> <?= $brg['keterangan']; ?></label>
                          		<a href="?id=<?= $brg['kode']; ?>" class="btn btn-xlg btn-block btn-success" data-toggle="modal" data-target="#order<?= $brg['kode']?>" role="button"><i class="fab fa-whatsapp mr-2"></i>Beli</a>
                        	</div>
                     	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php endforeach; ?>
<!-- MODAL ORDER --->
	<?php foreach ($barang as $brg ) :?>
	<div class="portfolio-modal modal fade" id="order<?= $brg['kode']?>" tabindex="-1" role="dialog" aria-labelledby="info<?= $brg['kode']?>" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                </div>
                <div class="modal-body text-center" style="padding: 0rem 1rem;">
                	<form action="" method="GET">
	                    <div class="container">
	                    	<h5>Order Barang</h5>
                         	<hr class="my">
	                    	<div class="row text-left">
	                    		<label for="order_nama" class="ml-2">Nama Barang</label>
                    			<input id="order_nama" type="text" class="form-control mb-2" name="order_nama" value="<?= $brg['nama']; ?>" readonly>
	                    	</div>
	                    	<div class="row text-left">
	                    		<label for="order_jumlah" class="ml-2">Jumlah &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp;  Stok: <?= $brg['stok']; ?></label>
                    			<input id="order_jumlah" type="number" class="form-control mb-2" name="order_jumlah" pattern="\d*" maxlength="2" min="1" max="<?= $brg['stok']; ?>" value="1" required>
	                    	</div>
	                    	<div class="row text-left">
	                    		<label for="order_namamu" class="ml-2">Namamu</label>
                    			<input id="order_namamu" type="text" class="form-control mb-2" name="order_namamu" required>
	                    	</div>
	                    	<div class="row text-left">
	                    		<label id="order_alamatmu" for="" class="ml-2">Alamatmu</label>
                    			<textarea id="order_alamatmu" class="form-control mb-2" name="order_alamatmu" required></textarea>
	                    	</div>
	                    	<div class="row text-left">
	                    		<label for="order_anter_ambil" class="ml-2">Anter / Ambil</label>
                    			<select class="form-control" id="order_anter_ambil" name="order_anter_ambil">
                    				<option value="Ku ambil sendiri aja">Ambil Sendiri</option>
                    				<option value="Anter bisa kak? ">Anterin</option>
                    			</select>	
	                    	</div>
	                    	<div class="row text-left">
	                    		<label for="order_bayar" class="ml-2 mt-2">Metode Pembayaran</label>
                    			<select class="form-control" id="order_bayar" name="order_bayar">
                    				<option value="COD aja kak">COD</option>
                    				<option value="Transfer ja kak">Transfer</option>
                    			</select>	
	                    	</div>
	                     	<div class="row justify-content-center">
	                        	<button type="submit" name="order_simpan" class="btn btn-sm btn-success btn-block mt-2" title="Melanjutkan ke Whatsapp"><i class="fab fa-whatsapp mr-2"></i>Beli!</button>
	                        </div>
	                        <div class="row justify-content-center mt-2 pb-0">
	                        	<p>Media ini hanya perantara adapun segala transaksi tetap melalui Whatsapp, Terimakasih!</p>
	                        </div>
	                    </div>
                  	</form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<!-- FOOTER -------->
	<div class="hak text-center text-white font-weight-bold p-2">
		<p> &copy 2020 ~ Created by AFComputer ~ <a class="wa" href="c"><i class="fab fa-whatsapp mr-1"></i>Hubungi Kami Via Whatsapp</a></p>
	</div>
<!-- JQuery -------->
    <?php require 'jquery.php'; ?>
  </body>
</html>