<?php
//koneksi ke database
$conn = mysqli_connect('localhost','root','','db_afc');


// Ambil data dari tabel Database untuk menampilkan ke web
function query($query) {
	global $conn;
	$result     = mysqli_query($conn, $query);
	$rows       = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

// ###################################### TAMBAH #################################
    // Menambah User
        function tambah_user($data) {
        	global $conn;
        	$nama      = ucwords($_POST["nama"]);
        	$no_hp	   = $_POST["no_hp"];
        	$username  = strtolower(stripcslashes($data["username"]));
        	$password  = mysqli_real_escape_string($conn, $data["password"]);
        	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
        	$level     = $_POST["level"];

            // Upload foto
            $foto = upload_foto();
                if (!$foto) {
                    return false;
                }

        	// Pemeriksaan kesediaan user
        	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        			if( mysqli_fetch_assoc($result) ) {
        			  echo "<script>alert('Username Sudah Ada')</script>";
        			  return false;
        			  }

        	// Memerika konfirmasi password
        	if( $password !== $password2) {
        		echo "<script>alert('Konfirmasi Password Salah')</script>";
        		return false;
        	}
        	// Enkripsi password
        	$password = password_hash($password, PASSWORD_DEFAULT);

        	// Menambah user baru ke database
        	mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$no_hp','$username','$password','$level','$foto')");
        	return mysqli_affected_rows($conn);
        }

    // Menambah barang
        function tambah_barang($barang) {
        	global $conn;        

            // Ambil data dari tiap elemen dari dalam form
            $waktu        = $barang["waktu"];
            $kategori     = $barang["kategori"];
            $nama         = $barang["nama"];
            $kondisi      = $barang["kondisi"];
            $stok         = $barang["stok"];
            $ukuran       = $barang["ukuran"];
            $harga_beli   = $barang["harga_beli"];
            $harga_jual   = $barang["harga_jual"];
            $keterangan   = $barang["keterangan"];

            // Upload gambar
            $gambar = upload_barang();
                if (!$gambar) {
                    return false;
                }

            // Masukan data ke database
            $tb_barang = "INSERT INTO barang VALUES('','$kategori','$waktu','$gambar','$nama','$kondisi','$stok','$ukuran','$harga_jual','$harga_beli','$keterangan')";
            mysqli_query($conn, $tb_barang);
            return mysqli_affected_rows($conn);
        }

    // Menambah pelanggan
        function tambah_pelanggan($pelanggan) {
        	global $conn;

        	// Ambil data dari tiap elemen dari dalam form
            $nama 	= $pelanggan["nama"];
            $no_hp 	= $pelanggan["no_hp"];
            $alamat = $pelanggan["alamat"];

            // Masukan data ke database
            $pelanggan = "INSERT INTO pelanggan VALUES('','$nama','$no_hp','$alamat')";
            mysqli_query($conn, $pelanggan);
            return mysqli_affected_rows($conn);
        }

    // Menambah Service
        function tambah_servis($servis) {
            global $conn;

            // Ambil data dari tiap elemen dari dalam form
            $tgl        = $servis["tgl"];
            $nama       = $servis["nama"];
            $servise    = $servis["servise"];
            $qty        = $servis["qty"];
            $harga      = $servis["harga"];
            $garansi    = $servis["garansi"];

            // Masukan data ke database
            $tb_servis = "INSERT INTO servis VALUES('','$tgl','$nama','$servise','$qty','$harga','$garansi')";
            mysqli_query($conn, $tb_servis);
            return mysqli_affected_rows($conn);
        }

    // Menambah Kategori
        function tambah_kategori($kategori) {
            global $conn;

            // Ambil data dari tiap elemen dari dalam form
            $kat  = $kategori["tambah_kategori"];
            $skat = $kategori["tambah_singkatan_kategori"];

            // Masukan data ke database
            $tb_kategori = "INSERT INTO kategori VALUES('','$kat','$skat')";
            mysqli_query($conn, $tb_kategori);
            return mysqli_affected_rows($conn);
        }

// ###################################### HAPUS ##################################
    // Menghapus user
        function hapus_user($id) {
        	global $conn;
        	mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
        	return mysqli_affected_rows($conn);
        }

    // Menghapus barang
        function hapus_barang($id) {
        	global $conn;
        	mysqli_query($conn, "DELETE FROM barang WHERE kode = $id");
        	return mysqli_affected_rows($conn);
        }

    // Menghapus Pelanggan
        function hapus_pelanggan($id) {
        	global $conn;
        	mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan = $id");
        	return mysqli_affected_rows($conn);
        }

    // Menghapus Kategori
        function hapus_kategori($id) {
            global $conn;
            mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");
            return mysqli_affected_rows($conn);
        }
        
// ###################################### EDIT ###################################
    // Mengedit Barang
        function edit_barang($barang) {
            global $conn;
            $id 	 	 = $barang["edit_id"];
            $nama		 = $barang["edit_nama"];
            $kategori    = $barang["edit_kategori"];
            $kondisi 	 = $barang["edit_kondisi"];
            $stok 		 = $barang["edit_stok"];
            $ukuran      = $barang["edit_ukuran"];
            $harga_beli  = $barang["edit_harga_beli"];
            $harga_jual	 = $barang["edit_harga_jual"];
            $keterangan	 = $barang["edit_keterangan"];
            $gambar_lama = $barang["edit_gambar_lama"];

            // Ganti Gambar atau engga
            if( $_FILES['edit_gambar_baru']['error'] === 4 ) {
                $edit_gambar_baru = $gambar_lama;   
            } else {
                $edit_gambar_baru = edit_upload_barang();
            }

            mysqli_query($conn, "UPDATE barang SET
                        gambar   		= '$edit_gambar_baru',
                        nama     		= '$nama',
                        kategori        = '$kategori',
                        kondisi  		= '$kondisi',
                        stok 	 		= '$stok',
                        ukuran          = '$ukuran',
                        harga_beli      = '$harga_beli',
                        harga_jual		= '$harga_jual',
                        keterangan  	= '$keterangan'
                        WHERE kode      = $id
                        ");
            return mysqli_affected_rows($conn);
        }

    // Mengedit Pelanggan
        function edit_pelanggan($pelanggan) {
            global $conn;

            $id 	 	 = $pelanggan["edit_id"];
            $nama 		 = $pelanggan["edit_nama"];
            $no_hp		 = $pelanggan["edit_no_hp"];
            $alamat 	 = $pelanggan["edit_alamat"];

            mysqli_query($conn, "UPDATE pelanggan SET
                        nama   			   = '$nama',
                        no_hp     		   = '$no_hp',
                        alamat  	 	   = '$alamat'
                        WHERE id_pelanggan = $id
                        ");
            return mysqli_affected_rows($conn);
        }

    // Mengedit User
        function edit_user($user) {
            global $conn;

            $id          = $user["edit_id"];
            $nama        = $user["edit_nama"];
            $no_hp       = $user["edit_no_hp"];
            $alamat      = $user["edit_alamat"];

            mysqli_query($conn, "UPDATE user SET
                        nama               = '$nama',
                        no_hp              = '$no_hp',
                        alamat             = '$alamat'
                        WHERE id_user      = $id
                        ");
            return mysqli_affected_rows($conn);
        }

// ###################################### UPLOAD #################################
    // Mengupload Foto Barang
        function upload_barang() {
            $namaBarang     = $_FILES['gambar']['name'];
            $ukuranBarang   = $_FILES['gambar']['size'];
            $errorBarang    = $_FILES['gambar']['error'];
            $tmpBarang      = $_FILES['gambar']['tmp_name'];

            // Cek ekstensi file yang di upload
            $ekstensiBarangValid = ['jpg','jpeg','png','bmp','gif'];
            $ekstensiBarang      = explode('.', $namaBarang);
            $ekstensiBarang      = strtolower(end($ekstensiBarang));

            if( !in_array($ekstensiBarang, $ekstensiBarangValid) ) {
                echo "<script>alert('Format gambar salah!')</script>";
                return false;
            }

            // Cek ukuran file yang di upload
            if( $ukuranBarang > 2000000) {
                echo "<script>alert('Ukuran gambar terlalu besar!')</script>";
                return false;
            }

            // Mengubah nama gambar
            $namaBarangBaru = uniqid();
            $namaBarangBaru.= '.';
            $namaBarangBaru.= $ekstensiBarang;

            // Upload gambar setelah lolos pengecekan
            move_uploaded_file($tmpBarang, 'img/barang/' . $namaBarangBaru);
            return $namaBarangBaru;
        }

    // Mengupload Foto User
        function upload_foto() {
            $namaFoto     = $_FILES['foto']['name'];
            $ukuranFoto   = $_FILES['foto']['size'];
            $errorFoto    = $_FILES['foto']['error'];
            $tmpFoto      = $_FILES['foto']['tmp_name'];

            // Cek ekstensi file yang di upload
            $ekstensiFotoValid = ['jpg','jpeg','png','bmp','gif'];
            $ekstensiFoto      = explode('.', $namaFoto);
            $ekstensiFoto      = strtolower(end($ekstensiFoto));

            if( !in_array($ekstensiFoto, $ekstensiFotoValid) ) {
                echo "<script>alert('Format foto salah!')</script>";
                return false;
            }

            // Cek ukuran file yang di upload
            if( $ukuranFoto > 2000000) {
                echo "<script>alert('Ukuran foto terlalu besar!')</script>";
                return false;
            }

            // Mengubah nama foto
            $namaFotoBaru = uniqid();
            $namaFotoBaru.= '.';
            $namaFotoBaru.= $ekstensiFoto;

            // Upload foto setelah lolos pengecekan
            move_uploaded_file($tmpFoto, 'img/user/' . $namaFotoBaru);
            return $namaFotoBaru;
        }

// ###################################### EDIT UPLOAD ############################
    // Mengupload Foto Barang
        function edit_upload_barang() {
            $namaBarangLama = $_POST['edit_gambar_lama'];            
            $namaBarang     = $_FILES['edit_gambar_baru']['name'];
            $ukuranBarang   = $_FILES['edit_gambar_baru']['size'];
            $errorBarang    = $_FILES['edit_gambar_baru']['error'];
            $tmpBarang      = $_FILES['edit_gambar_baru']['tmp_name'];

            // Cek ekstensi file yang di upload
            $ekstensiBarangValid = ['jpg','jpeg','png','bmp','gif'];
            $ekstensiBarang      = explode('.', $namaBarang);
            $ekstensiBarang      = strtolower(end($ekstensiBarang));

            if( !in_array($ekstensiBarang, $ekstensiBarangValid) ) {
                echo "<script>alert('Format gambar salah!')</script>";
                return false;
            }

            // Cek ukuran file yang di upload
            if( $ukuranBarang > 2000000) {
                echo "<script>alert('Ukuran gambar terlalu besar!')</script>";
                return false;
            }

            // Mengubah nama gambar
            $namaBarangBaru = uniqid();
            $namaBarangBaru.= '.';
            $namaBarangBaru.= $ekstensiBarang;

            // Upload gambar baru setelah lolos pengecekan
            unlink("img/barang/".$namaBarangLama);
            move_uploaded_file($tmpBarang, 'img/barang/' . $namaBarangBaru);
            
            return $namaBarangBaru;
           
        }
?>