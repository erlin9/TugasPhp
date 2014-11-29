<?php 
session_start();
include ('../koneksi.php');
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
	
	$jam = strip_tags(trim($jam));
		
	if (($jam != ""))
	{
			$sql="UPDATE tb_jam SET 
					id_jam='".$id_ubah_jam_nya."', 
					jam='".$jam."' WHERE id_jam = '".$id_ubah_jam_nya."'";
			$hasil=mysql_query($sql);
	
			echo"<br><br>";
			echo"<center>Anda Berhasil Merubah Jam</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=jam1'><center><b>Tampilkan</b></center></a>";
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Merubah Jam !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_jam_ubah.php?id_ubah_jam=".$id_ubah_jam_nya."'><center><b>< Kembali</b></center></a>";
	}
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>