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
<?php 

include('../koneksi.php');	
if (($_POST[nama_program] != "")&&($_POST[tingkat] != "")&&($_POST[biaya] != ""))
	{	
//SQL memasukkan data di table form	
mysql_query("UPDATE tb_biaya SET
			id_biaya = '$_POST[id]',
			id_program ='$_POST[nama_program]',
            tingkat ='$_POST[tingkat]',
			biaya ='$_POST[biaya]'
			WHERE id_biaya ='$_POST[id]'"); 
?>

 <?php

 		echo"<br><br>";
		echo"<center>Anda Berhasil Merubah Data Biaya !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_index.php?show=biaya1'><center><b>Kembali</b></center></a>";
	    echo"<br><br>";
    
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Merubah Data Biaya !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_biaya_ubah.php?id_ubah=".$_POST[id]."'><center><b>Kembali</b></center></a>";
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