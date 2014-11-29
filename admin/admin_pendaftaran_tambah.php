<?php 
session_start();
include ('../koneksi.php');
?>
<style type="text/css">
<!--
.style3 {font-size: 10px}
.style4 {font-size: 14px}
-->
    </style>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
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
<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=pendaftaran1'><b>Admin Pendaftaran</b></a> | Admin Pendaftaran Tambah<br/>
<form id="identitasForm" name='pendaftaran_tambah' action='admin_pendaftaran_simpan.php' method='post' enctype="multipart/form-data">
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
	<tr>
	<td align='center' height='30' colspan='5' class='k2'>FORMULIR PENDAFTARAN</td>
	</tr>
    <tr>
	<td colspan='5'>&nbsp;</td>
	</tr>
    <tr>
	<td colspan='5' align="center">
	<?php
$jenis = 'G';
$query = "SELECT max(id_siswa) as maxID FROM tb_pendaftaran WHERE id_siswa LIKE '$jenis%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$idMax = $data['maxID'];
$noUrut = (int) substr($idMax, 1, 5);
$noUrut++;
$newID = $jenis . sprintf("%05s", $noUrut);
?>
   <input type="hidden" name="id_siswa" value="<?php echo $newID; ?>"/>
    
    <table width='500' border='0' bgcolor='#FFFF66' cellpadding='2' cellspacing='2' >
    <tr>
	<td >&nbsp;</td>
    <td align='left' valign='top'>Nama</td>
	<td align='left' valign='top'>:</td>
	<td  width="350" align='left' valign='top'><input type="text" name="nama" class="required"  title="NAMA harus diisi"  /></td>
    <td>&nbsp;</td>
	</tr>
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Jenis Kelamin</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="radio" id="jeniskelamin1" name="jeniskelamin" value="laki-laki"
    class="validate[required] radio" />laki - laki
	  <input type="radio" id="jeniskelamin2" name="jeniskelamin" value="perempuan"
    class="validate[required] radio" />
	  perempuan</td>
     <td align='left' valign='top'>&nbsp;</td>   
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Tempat Lahir</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="tempat_lahir"  class="required"  title="TEMPAT LAHIR harus diisi"  /></td>
    <td>&nbsp;</td>
	</tr>
    
	<tr>
    <td width='5'>&nbsp;</td>
	<td width='25%' align='left' valign='top'>Tanggal Lahir</td>
    <td align='left' valign='top'>:</td>
    <td width='70%' align='left' valign='top'><input value="" name="tgl_lahir" class="validate[required] picker" type="text" /> </td>
    <td width='5'>&nbsp;</td>
    </tr>
	<tr>
	<td>&nbsp;</td>
	<td align='left' valign='top'>Alamat Rumah/Kos</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><textarea name='alamat' rows='3' cols='25'></textarea></td>
	<td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Kode Pos</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="kodepos"  class="required"  title="KODEPOS harus diisi"  /></td>
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Tlp Rumah/HP</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="nohp"  class="required number" minlength="13"  title="Tlp Rumah/HP harus diisi"  /></td>
    <td>&nbsp;</td>
	</tr>
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>E-mail</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="email"  class="required email"  title="EMAIL harus diisi"/> </td>
    <td>&nbsp;</td>
	</tr>
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Asal Sekolah</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="asal_sekolah"  class="required"  title="ASAL SEKOLAH harus diisi"/> </td>
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Kelas</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'>
     <select class="required" name="kelas">
          <option value="">- Pilih Kelas-</option>
         <?php $kls=mysql_query("SELECT DISTINCT(tingkat) FROM tb_biaya ORDER BY tingkat ASC");
		  		while($kl=mysql_fetch_array($kls)){?>
          <option value="<?=$kl[tingkat];?>"><?=$kl[tingkat];?></option>
          <? } ?>
     </select>
    </td>
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Program Bimbingan</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'>
    <select class="" name="nama_program">
          <option value="">- Pilih Program Bimbingan</option>
          <?php $probim=mysql_query("SELECT * FROM tb_program ORDER BY nama_program ASC");
		  		while($pr=mysql_fetch_array($probim)){?>
          <option value="<?=$pr[id_program];?>"><?=$pr[nama_program];?></option>
          <? } ?>
    </select>
    
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Nama Orang Tua</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="ortu"  class="required"  title="Nama Orang Tua harus diisi"/> </td>
    <td>&nbsp;</td>
	</tr>
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Tempat Bimbingan</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'>
    <select class="" name="tempat_bimbingan">
          <option value="">- Pilih Lokasi - </option>
         <?php $tmpt=mysql_query("SELECT * FROM tb_alamat ORDER BY id_alamat ASC");
		  		while($tmp=mysql_fetch_array($tmpt)){?>
          <option value="<?=$tmp[id_alamat];?>"><?=$tmp[id_alamat];?></option>
          <? } ?>
     </select>
      </td>
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Photo</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="file" name="photo" class="required" title="PHOTO harus diisi"/> *<span class="style3">Ukuran max. 500-1000kb</span></td>
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td colspan='5'>&nbsp;</td>
	</tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td align='left'><input type='submit' value='Kirim' name="add_photo"></td>
	<td>&nbsp;</td>
	<tr>
	<td colspan='5'>&nbsp;</td>
	</td>
    </tr>
    
    </table>
	</table>
	</form></br>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>


