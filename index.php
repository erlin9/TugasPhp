<?php 
session_register();
include ('koneksi.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="slider/engine1/style.css"/>
	<style type="text/css">a#vlb{display:none}</style>
	<script type="text/javascript" src="slider/engine1/jquery.js"></script>
	<script type="text/javascript" src="slider/engine1/wowslider.js"></script>
    <link rel="stylesheet" type="text/css" href="css/css.css" />
    <link rel="stylesheet" type="text/css" href="css/datepicker-flora.datepicker.css" />
   
    
	<script language="javascript" type="text/javascript" src="slider/js/datepicker-jquery.validationEngine-en.js"></script>
	<script language="javascript" type="text/javascript" src="slider/js/datepicker-jquery.validationEngine.js"></script>
	<script language="javascript" type="text/javascript" src="slider/js/datepicker-ui.datepicker.js"></script>
	<script language="javascript">
	 $(document).ready(function(){
	$("#form-validate").validationEngine();
	$(".picker").datepicker();
});
</script>
<link rel="stylesheet" type="text/css" href="css/validasi-style.css" />
<script type="text/javascript" src="slider/js/validasi-jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#identitasForm").validate({

	});
})
</script>
	<!-- End WOWSlider.com HEAD section -->
</head>

<body>

<div id="wrapper">
	<div id="menu" align="center">
		<a href="?show=home" 
        <?php if($_GET[show]=='home'){ ?>class="active" <? } ?>>UTAMA</a>&nbsp;&nbsp;&nbsp;||&nbsp;
		<a href="?show=sejarah"
        <?php if($_GET[show]=='sejarah'){ ?>class="active" <? } ?>>SEJARAH</a>&nbsp;&nbsp;&nbsp;||&nbsp;
        <a href="?show=biaya"
        <?php if($_GET[show]=='biaya'){ ?>class="active" <? } ?>>BIAYA &amp; JADWAL</a>&nbsp;&nbsp;&nbsp;||&nbsp;
        <a href="?show=pendaftaran"
        <?php if($_GET[show]=='pendaftaran'){ ?>class="active" <? } ?>>PENDAFTARAN</a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;
        <a href="?show=kontak"
        <?php if($_GET[show]=='kontak'){ ?>class="active" <? } ?>>KONTAK</a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;
        <a href="?show=lihat_buku_tamu"
        <?php if($_GET[show]=='buku_tamu'){?>class="active" <? } ?>>BUKU TAMU</a>&nbsp;&nbsp;&nbsp;
	</div>
	<div id="header">
		<!-- Start WOWSlider.com BODY section -->
      <div id="wowslider-container1">
          <div class="ws_images"> 
          <img src="slider/data1/images/brosur4.jpg" alt="header1" title="header1" id="wows0"/> 
          <img src="slider/data1/images/brosur5.jpg" alt="header2" title="header2" id="wows1"/> 
          <img src="slider/data1/images/brosur3.jpg" alt="header3" title="header3" id="wows2"/> 
          </div>
          <script type="text/javascript" src="slider/engine1/script.js"></script>
          <!--	<div class="ws_shadow"></div> -->
      </div>
	</div><!-- End WOWSlider.com BODY section -->
		<div id="utama">
		<div id="main">
		<div id="atas"> 
  		<div id="kiri">
        <div class="k-judul" align="center">
    	>>Program Bimbingan<<
        </div>
        <table align="center"  width="109" border="0">
  <tr>
    <td height="20">&curren;&nbsp;<a href="?show=reguler"<?php if($_GET[show]=='reguler'){ ?>class="active" <? } ?>>REGULER</a></td>
  </tr>
  <tr>
    <td height="20">&curren;&nbsp;<a href="?show=semi_privat"<?php if($_GET[show]=='semi_privat'){ ?>class="active" <? } ?>>SEMI PRIVAT</a></td>
  </tr>
  <tr>
    <td height="20">&curren;&nbsp;<a href="?show=privat_sanggar"<?php if($_GET[show]=='privat_sanggar'){ ?>class="active" <? } ?>>PRIVAT SANGGAR</a></td>
  </tr>
  <tr>
    <td height="20">&curren;&nbsp;<a href="?show=privat_rumah"<?php if($_GET[show]=='privat_rumah'){ ?>class="active" <? } ?>>PRIVAT RUMAH</a></td>
  </tr>
</table><br />  	
  		<div class="k-judul" align="center">
    	>>Lihat Hasil Try Out<<
    	</div>
 	 	<form method="post" action="?show=tryout">
  		<table  align="center" width="227" border="0" cellpadding="0" cellspacing="0">
       	<tr align="left">
      	<th width="100" height="24" scope="row">Nomor Siswa</th>
      	<td width="3">:</td>
      	<td width="80" colspan="4"><input type="text" name="id_siswa" width="80" /></td>
    	</tr>
      	<tr>
    	<th scope="row">&nbsp;</th>
    	<td>&nbsp;</td>
    	<td colspan="4" align="left">&nbsp;</td>
 		</tr>
 		<tr>
    	<th scope="row">&nbsp;</th>
   	 	<td>&nbsp;</td>
   	 	<td colspan="4" align="left"><input type="submit" value="Lihat"/></td>
  		</tr>
  		</table>
		</form><br />		
        <div class="k-judul" align="center">
    	>>Kalender<<
        </div>
        <div class="kalender" >
        <?php include ('kalender.php');?>
    	</div><hr color="#FFFFFF" />
  	</div>
    
    <div id="kanan" align="justify">
    <? if($_GET[show]=='home') { ?>
    	<h2 align="center"><blink>..:Selamat Datang:..</blink></h2>
		<h3>&nbsp;&nbsp;&nbsp;Visi Galileone</h3> 
		<?php 
		$visi = mysql_query("select * from tb_visi");
		while ($vs = mysql_fetch_array($visi)){ ?>
		<p align="justify"><? echo"$vs[isi]";?></p>
		<? }?> 
		<br /><h3>&nbsp;&nbsp;&nbsp;Misi Galileone</h3> 
		<?php 
		$misi = mysql_query("select * from tb_misi");
		while ($ms=mysql_fetch_array($misi)){
		?>
		<p align="justify"> <? echo"$ms[isi]";?></p>
		<? }?><hr color="#FFFFFF"/>
    </div>
	<? }?>
    </div>
<?php 
if($_GET[show]=='home'){
include ("utama.php");
}elseif ($_GET[show]=='sejarah'){
include ("sejarah.php");
}elseif ($_GET[show]=='biaya'){
include ("biaya.php");
}elseif ($_GET[show]=='pendaftaran'){
include ("pendaftaran_input.php");
}elseif ($_GET[show]=='buku_tamu'){
include ("bukutamu_tambah.php");
}elseif ($_GET[show]=='kontak'){
include ("kontak.php");
}elseif ($_GET[show]=='reguler'){
include ("reguler.php");
}elseif ($_GET[show]=='semi_privat'){
include ("semi_privat.php");
}elseif ($_GET[show]=='privat_sanggar'){
include ("privat_sanggar.php");
}elseif ($_GET[show]=='privat_rumah'){
include ("privat_rumah.php");
}elseif ($_GET[show]=='berita'){
include ("berita.php");
}elseif ($_GET[show]=='tryout'){
include ("tryout.php");
}elseif ($_GET[show]=='pilihan_berita'){
include ("pilihan_berita.php");
}elseif ($_GET[show]=='lihat_buku_tamu'){
include ("lihat_buku_tamu.php");
}else{echo"<script>window.location.href='index.php?show=home'</script> ";}?>
</div>
<div id="footer" align="center" ><br />
Galileone Official Site © 2012 </div>
</div>
</div>

</body>
</html>