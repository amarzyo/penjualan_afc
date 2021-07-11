<?php 
	// Menghubungkan ke file koneksi
	require 'koneksi.php';

	// Function untuk menghapus data Registrasi
	$id = $_GET["id"];
	if( hapus_user($id) > 0 ) {
		echo "<script>
				alert('User Deleted!');
				document.location.href = 'list_user.php';
			 </script>";
	} else {
		echo "<script>
				alert('Failed to Deleted!');
				document.location.href = 'list_user.php';
			 </script>";
	}

?>