<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
		<div id="utama">
		<div id="main">
<?
//------------------------------------isi wab----------------------------
	include "../koneksi.php";
	extract($_GET);
	
	$probim = strip_tags(trim($probim));
		
	if (($nama_program != "")&&($deskripsi != ""))
	{
			$sql="UPDATE tb_program SET 
					id_program='".$id_ubah_probim_nya."',
					nama_program='".$nama_program."',
					deskripsi='".$deskripsi."' WHERE id_program = '".$id_ubah_probim_nya."'";
			$hasil=mysql_query($sql);
	
			echo"<br><br>";
			echo"<center>Anda Berhasil Merubah Program</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=probim1'><center><b>Tampilkan</b></center></a>";
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Merubah Program !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_probim_ubah.php?id_ubah_probim=".$id_ubah_probim_nya."'><center><b>Kembali</b></center></a>";
	}
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>