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
	
	//------tag html ga di baca strip_tags
	$alamat = strip_tags(trim($alamat));
	
	if (($alamat != "")&&($id_alamat != "")&&($tlp != "")&&($hp != ""))
	{
			$sql="INSERT INTO tb_alamat (id_alamat, alamat, tlp, hp) 
					VALUES ('".$id_alamat."', '".$alamat."', '".$tlp."', '".$hp."')";
			$hasil=mysql_query($sql);
	
			echo"<br><br>";
			echo"<center>Anda Berhasil Menambah Alamat</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=alamat1'><center><b>Tampilkan</b></center></a>";
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Menambah Alamat !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_alamat_tambah.php'><center><b>Kembali</b></center></a>";
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