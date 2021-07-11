<?php
// Menngapus SESSION 
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// Menghapus COOKIE
setcookie('id_user','', time()-3600);
setcookie('key','', time()-3600);

// Mengalihkan
header('location:login.php');
?>