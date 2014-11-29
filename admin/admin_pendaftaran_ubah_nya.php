<?php 
session_start();
include ('../koneksi.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
	<link rel="stylesheet" type="text/css" href="../slider/engine1/style.css"/>
	<style type="text/css">a#vlb{display:none}</style>
	<script type="text/javascript" src="../slider/engine1/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
		<div id="utama">
		<div id="main">
<?php 

include('../koneksi.php');	
if (($_POST[nama] != "")&&($_POST[id] != ""))
	{
if($_POST[edit_photo]!=""){
	if($_FILES['photo']['type']!=""){   
	$namafot=date("dmYHis");
	copy($_FILES['photo']['tmp_name'],"../upload/".$namafot.".jpg");
					 }else{
		$namafot=$_POST[hiddenphoto];						 
					 }
	
//SQL memasukkan data di table form	
mysql_query("UPDATE tb_pendaftaran SET
			id_siswa = '$_POST[id]',
			nama_siswa ='$_POST[nama]',
            jk ='$_POST[jeniskelamin]',
			tempat_lahir ='$_POST[tempat_lahir]',
			tgl_lahir ='$_POST[tgl_lahir]',
			alamat ='$_POST[alamat]',
			kode_pos = '$_POST[kodepos]',
			no_tlp ='$_POST[no_tlp]',
			email ='$_POST[email]',
			asal_sekolah = '$_POST[asal_sekolah]',
			kelas =  '$_POST[kelas]',
			id_program ='$_POST[nama_program]',
			ortu ='$_POST[ortu]',
			id_alamat ='$_POST[tempat_bimbingan]',
			photo ='$namafot'
			WHERE id_siswa ='$_POST[id]'"); 
?>

 <?php

 		echo"<br><br>";
		echo"<center>Anda Berhasil Merubah Data Pendaftaran !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_index.php?show=pendaftaran1'><center><b>Kembali</b></center></a>";
	    echo"<br><br>";
    }
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Merubah Data Pendaftaran !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_pendaftaran_ubah.php?id_ubah=".$_POST[id]."'><center><b>Kembali</b></center></a>";
			echo"<br><br>";
} 
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>