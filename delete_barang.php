<?php 
	// Menghubungkan ke file koneksi
	require 'koneksi.php';

	// Function untuk menghapus data produk
	$id 	= $_GET["id"];
	$file	= $_GET["gbr"];

	if( hapus_barang($id) > 0 ) {
		echo "<script>
				alert('BERHASIL');
				document.location.href = 'dashboard.php';
			 </script>";			             
        unlink("img/barang/".$file);
	} else {
		echo "<script>
				alert('GAGAL');
				document.location.href = 'dashboard.php';
			 </script>";
	}

?>