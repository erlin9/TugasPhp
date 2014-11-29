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

	if (($id_siswa != "")&&($nama_siswa != "")&&($asal_sekolah != "")&&($skor != ""))
	{
	mysql_query("INSERT INTO tb_to (id_to, id_siswa, nama_siswa, kelas, asal_sekolah, skor) 
	VALUES ('".$_POST[id_to]."', '".$_POST[id_siswa]."','".$_POST[nama_siswa]."', '".$_POST[kelas]."', '".$_POST[asal_sekolah]."','".$_POST[skor]."')");
		
			echo"<br><br>";
			echo"<center>Anda Berhasil Menambah Data TO</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=tryout'><center><b>Tampilkan</b></center></a>";
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Menambah Data TO !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_tryout_tambah.php'><center><b> Kembali</b></center></a>";
		echo"<br><br>";
	}
?>
<div id="footer" align="center" ><br />
Galileone Official Site © 2012 </div>
</div>
</div>
</div>
</body>
</html>