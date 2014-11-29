<?php 
session_start();
include ('../koneksi.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="../slider/engine1/style.css"/>
	<style type="text/css">a#vlb{display:none}</style>
	<script type="text/javascript" src="../slider/engine1/jquery.js"></script>
	
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
    <link rel="stylesheet" type="text/css" href="../css/datepicker-flora.datepicker.css" />
       
	<script language="javascript" type="text/javascript" src="../slider/js/datepicker-jquery.validationEngine-en.js"></script>
	<script language="javascript" type="text/javascript" src="../slider/js/datepicker-jquery.validationEngine.js"></script>
	<script language="javascript" type="text/javascript" src="../slider/js/datepicker-ui.datepicker.js"></script>
	<script language="javascript">
	 $(document).ready(function(){
	$("#form-validate").validationEngine();
	$(".picker").datepicker();
});
</script>

	<!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
		<div id="utama">
		<div id="main">
<?php

	include "../koneksi.php";
		
	if (($_POST[judul] != "")&&($_POST[sumber] != "")&&($_POST[isi] != "")&&($_POST[tanggal] != ""))
	{
	if($_POST[add_photo]!=""){
	if($_FILES['photo']['type']!=""){   
	$namafot=date("dmYHis");
	copy($_FILES['photo']['tmp_name'],"../upload/".$namafot.".jpg");
					 }else{
		$namafot="kosong";						 
					 }

			mysql_query("INSERT INTO tb_berita (id_berita, tgl, judul, isi, sumber, photo) 
					VALUES ('".$_POST[id]."', '".$_POST[tanggal]."','".$_POST[judul]."', '".$_POST[isi]."', '".$_POST[sumber]."','".$namafot."')");
	
			echo"<br><br>";
			echo"<center>Anda Berhasil Menambah Berita</center>";
			echo"<br><br>";
			echo"<a href='admin_index.php?show=berita1'><center><b>Tampilkan</b></center></a>";
				echo"<br><br>";
		}
	}
	else
	{
		echo"<br><br>";
		echo"<center>Anda Belum Berhasil Menambah Berita !!!</center>";
		echo"<br><br>";
		echo"<a href='admin_berita_tambah.php'><center><b>Kembali</b></center></a>";
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