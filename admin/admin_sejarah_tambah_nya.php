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
	include ('../koneksi.php');
	if ($_POST[sejarah] != "")
	{
	if($_POST[add_photo]!=""){
	if($_FILES['photo']['type']!=""){   
	$namafot=date("dmYHis");
	copy($_FILES['photo']['tmp_name'],"../upload/".$namafot.".jpg");
					 }else{
		$namafot="kosong";						 
					 }

			mysql_query("INSERT INTO tb_sejarah (id_sejarah, sejarah, photo) 
					VALUES ('".$_POST[id]."', '".$_POST[sejarah]."', '".$namafot."')");
	
			echo"<br><br>";
			echo"<center>Anda Berhasil Menambah Sejarah</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=sejarah1'><center><b>Tampilkan</b></center></a>";
				echo"<br><br>";
		}
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Menambah Sejarah !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_sejarah_tambah.php'><center><b>Kembali</b></center></a>";
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