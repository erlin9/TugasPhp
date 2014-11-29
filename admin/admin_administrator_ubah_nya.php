<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="../slider/engine1/style.css"/>
	<style type="text/css">a#vlb{display:none}</style>
	<script type="text/javascript" src="../slider/engine1/jquery.js"></script>
	<script type="text/javascript" src="../slider/engine1/wowslider.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
    <!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
		<div id="utama">
		<div id="main">
<?
//------------------------------------isi wab----------------------------
	include "../koneksi.php";
	extract($_POST);
	
	$username = strip_tags(trim($username));
	$password = strip_tags(trim($password));
	$konfirms_password = strip_tags(trim($konfirms_password));
		
	if (($id_pegawai != "")&&($username != "")&&($password != "")&&($konfirms_password != ""))
	{
		if(($password == $konfirms_password))
		{
			$sql="UPDATE tb_admin SET 
					id_pegawai='".$id_pegawai."', 
					username='".$username."', 
					password='".$password."' WHERE id_admin = '1'";
			$hasil=mysql_query($sql);
	
	
			echo"<br><br>";
			echo"<center>Username dan Password Berhasil Di Rubah</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=data_admin'><center><b>Tampilkan</b></center></a>";
	    }
	      else
	    {
		    echo"<br><br>";
			echo"<center>Username dan Password Yang Anda Masukkan Kurang Lengkap !!!</center>";
			echo"<br><br>";
			echo"<a href='admin_administrator_ubah.php?id_ubah=".$id_ubah_nya."'><center><b>Kembali</b></center></a>";
	   }
	}
	else
	{
		    echo"<br><br>";
			echo"<center>Username dan Password Yang Anda Masukkan Kurang Lengkap !!!</center>";
			echo"<br><br>";
			echo"<a href='admin_administrator_ubah.php?id_ubah=".$id_ubah_nya."'><center><b>Kembali</b></center></a>";
		}
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>