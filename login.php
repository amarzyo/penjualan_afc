<?php
  // Memulai SESSION
  session_start();

  // Mengubungkan ke DATABASE
  require 'koneksi.php';

  // Memeriksa COOKIE jika sudah maka akan dirahakan ke halaman order
  if( isset($_COOKIE['id_user']) && isset($_COOKIE['key']) ) {
    $id_user = $_COOKIE['id_user'];
    $key     = $_COOKIE['key'];

    // Ambil username berdasarkan id_user
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id_user = $id_user");
    $row    = mysqli_fetch_assoc($result);

    // Cek COOKIE dan username
    if( $key === hash('sha256', $row['username']) ) {
      $_SESSION['login'] = true;
    }
  }

  // Memeriksa SESSION jika sudah maka akan dirahakan ke halaman order
  if( isset($_SESSION["login"]) ) {
    header("location: order.php");
    exit;
  }

  // Ketika tombol Login di tekan
  if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

   // Memeriksa USERNAME
   if( mysqli_num_rows($result) === 1 ) {

    // Memeriksa PASSWORD
    $row = mysqli_fetch_assoc($result);
     if( password_verify($password, $row["password"]) ) {

       // Set SESSION
       $_SESSION["login"] = true;

       // Cek remember me
       if( isset($_POST['remember']) ){

          // Membuat COOKIE
          setcookie('id_user', $row['id_user'], time()+600);
          setcookie('key', hash('sha256', $row['username']), time()+600);
       }

      header("location: order.php");
      exit;
      }
   }
  }?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="icon" type="image/x-icon" href="img/logo.png" />
    <title>َLogin - AFComputer</title>
    <link rel="stylesheet" href="css/style-login.css">
  </head>
  <body>
  <form class="box" action="" method="post">
    <a href="index.php" type="text" style="color: #fff;"><img src="img/logo.png" width="100" height="100"></a>
    <h3 style="color: white;">Login | AFComputer</h3>
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="remember">
    <label style="color: white;"> Remember me </label>
    <input type="submit" name="login" value="Login">
    <label style="color: white;">&copy 2020 | Created by AFComputer ~ <a style="color: white;" href="https://api.whatsapp.com/send?phone=6285742166695&text=&source=&data=&app_absent=">085742166695</a></label>
  </form>
  </body>
</html>
