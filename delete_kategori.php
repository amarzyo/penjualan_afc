<?php 
	// Menghubungkan ke file koneksi
	require 'koneksi.php';

	// Function untuk menghapus data produk
	$id = $_GET["id"];
	if( hapus_kategori($id) > 0 ) {
		echo "<script>
				alert('BERHASIL');
				document.location.href = 'dashboard.php';
			 </script>";
	} else {
		echo "<script>
				alert('GAGAL');
				document.location.href = 'dashboard.php';
			 </script>";
	}

?>