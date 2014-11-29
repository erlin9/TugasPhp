<?php
session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
echo "<h2 align=center> Maaf Anda Harus Login Dulu!!</h2>";
echo"<center> 4 detik lagi</center>";
echo "<meta http-equiv='refresh' content='4;url=admin_login.php'>";
}
else{
?>
<?php
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
</head>

<body>

<div id="wrapper">
<div id="header" align="center"></div>
	
		<div id="utama">
		<div id="main">
		<div id="atas"> 
  		<div id="kiri">
        <div class="k-judul" align="center">
    	>>Menu Admin<<
        </div>
        <table align="center"  width="148" border="0">
        <tr>
        <td width="102">&curren;&nbsp;<a href="?show=home1" <?php if($_GET[show]=='home1'){ ?>class="active" <? } ?>>UTAMA</a>
        </td>
        </tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=sejarah1"<?php if($_GET[show]=='sejarah1'){ ?>class="active" <? } ?>>SEJARAH</a>
        </td>
        </tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=admin_visimisi"<?php if($_GET[show]=='admin_visimisi'){ ?>class="active" <? } ?>>VISI MISI</a>
        </td>
        </tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=jam1"<?php if($_GET[show]=='jam1'){ ?>class="active" <? } ?>>JAM</a>
        </td>
        </tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=biaya1"<?php if($_GET[show]=='biaya1'){ ?>class="active" <? } ?>>BIAYA</a>
        </td>
        </tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=pendaftaran1"<?php if($_GET[show]=='pendaftaran1'){ ?>class="active" <? } ?>>PENDAFTARAN</a>
        </td></tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=tryout"<?php if($_GET[show]=='tryout'){ ?>class="active" <? } ?>>DATA TRY OUT</a>
        </td>
        </tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=alamat1"<?php if($_GET[show]=='alamat1'){ ?>class="active" <? } ?>>ALAMAT</a>
        </td></tr>
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=bukutamu1"<?php if($_GET[show]=='bukutamu1'){?>class="active" <? } ?>>BUKU TAMU</a>
        </td></tr> 
        <tr>
        <td height="20">&curren;&nbsp;<a href="?show=berita1"<?php if($_GET[show]=='berita1'){ ?>class="active" <? } ?>>BERITA</a>
        </td>
        </tr> 
        <tr>
    <td height="20">&curren;&nbsp;<a href="?show=probim1"<?php if($_GET[show]=='probim1'){ ?>class="active" <? } ?>>PROGRAM BIMBINGAN</a></td>
  </tr>
    <tr>
    <td height="20">&curren;&nbsp;<a href="?show=data_admin"<?php if($_GET[show]=='data_admin'){ ?>class="active" <? } ?>>DATA ADMIN</a></td>
  </tr>
  <tr>
    <td height="20">&curren;&nbsp;<a href="logout.php" >LOGOUT</a></td>
  </tr>
</table><br />
            	
    	</div>
  		</div>
        
         <? if($_GET[show]=='home1') { ?>
         	<div id="kanan" align="center"> 
 			
              <p align="right">Tanggal dan jam sekarang :
   <?php 
   include('../fungsi/fungsi_indo_tgl.php');
   echo "<b>";
   echo tgl_indo(date("Y m d"));  
   echo "&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;" ;  
   echo date("H:i:s"); 
   echo "</b>";
   ?> 
   </p> 
             <br /><br /><br />
             Selamat datang, di halaman Administrator<br />
			Bimbingan Belajar Galileone<br />
			Halaman ini Anda bisa mengisi, menghapus dan<br />
			mengganti data yang akan di tampilkan pada publik. <br />
        <? } ?>
<?php 
if($_GET[show]=='home1'){
include ("utama.php");
}elseif ($_GET[show]=='sejarah1'){
include ("admin_sejarah.php");
}elseif ($_GET[show]=='admin_sejarah_ubah'){
include ("admin_sejarah_ubah.php");
}elseif ($_GET[show]=='admin_visimisi'){
include ("admin_visi_dan_misi.php");
}elseif ($_GET[show]=='admin_visi_ubah'){
include ("admin_visi_ubah.php");
}elseif ($_GET[show]=='admin_misi_ubah'){
include ("admin_misi_ubah.php");
}elseif ($_GET[show]=='jam1'){
include ("admin_jam.php");
}elseif ($_GET[show]=='biaya1'){
include ("admin_biaya.php");
}elseif ($_GET[show]=='pendaftaran1'){
include ("admin_pendaftaran.php");
}elseif ($_GET[show]=='tryout'){
include ("admin_tryout.php");
}elseif ($_GET[show]=='bukutamu1'){
include ("admin_bukutamu.php");
}elseif ($_GET[show]=='alamat1'){
include ("admin_alamat.php");
}elseif ($_GET[show]=='probim1'){
include ("admin_probim.php");
}elseif ($_GET[show]=='data_admin'){
include ("admin_administrator.php");
}elseif ($_GET[show]=='berita1'){
include ("admin_berita.php");
}else{echo"<script>window.location.href='admin_index.php?show=home1'</script> ";}?>
</div></div>
<div id="footer" align="center" ><br />
Galileone Official Site © 2012 </div>
</div>
</div>
</body>
</html>
<? } ?>