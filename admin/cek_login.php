<?php
include ('../koneksi.php');
$pass=md5($_POST[password]);
$login=mysql_query("SELECT * FROM tb_admin WHERE username='$_POST[username]' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  session_register("namauser");
  session_register("passuser");

  $_SESSION[id]=$r[id_admin];
  $_SESSION[namauser]=$r[username];
  $_SESSION[passuser]=$r[password];
  header('location:admin_index.php');
}
else{
	echo "<script>alert('Silakan periksa Username dan Password anda..!');window.history.go(-1);</script>";
}
?>
