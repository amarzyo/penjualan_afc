<?php 
	// Menghubungkan ke file koneksi
	require 'koneksi.php';


	// Function untuk menghapus data Registrasi
	$id = $_GET["id"];
	if( hapus_pelanggan($id) > 0 ) {
		echo "<script>
				alert('Pelanggan Deleted!');
				document.location.href = 'list_pelanggan.php';
			 </script>";
	} else {
		echo "<script>
				alert('Failed to Deleted!');
				document.location.href = 'list_pelanggan.php';
			 </script>";
	}

?>