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
			$sql="DELETE FROM tb_berita WHERE id_berita = '".$id_hapus."'";
			$hasil=mysql_query($sql);
	        unlink("../"."upload/".$gambar.".jpg");			
			echo"<br><br>";
			echo"<center>Anda Berhasil Menghapus Berita</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=berita1'><center><b>Kembali</b></center></a>";
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>