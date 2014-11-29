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
	
	$visi = strip_tags(trim($visi));
		
	if (($visi != ""))
	{
			$sql="UPDATE tb_visi SET 
					id_visi='".$id_ubah_visi_nya."', 
					isi='".$visi."' WHERE id_visi = '".$id_ubah_visi_nya."'";
			$hasil=mysql_query($sql);
	
			echo"<br><br>";
			echo"<center>Anda Berhasil Merubah Visi</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=admin_visimisi'><center><b>Tampilkan</b></center></a>";
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Merubah Visi !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_visi_ubah.php?id_ubah_visi=".$id_ubah_visi_nya."'><center><b>< Kembali</b></center></a>";
	}
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>