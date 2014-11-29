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
 echo "<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=pendaftaran1'><b>Admin Pendaftaran</b></a> | Lihat Biodata Pendaftar";
 echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>BIODATA PENDAFTARAN</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";

switch($_GET[act]){
 default:
 $tampil=mysql_query("select * from tb_pendaftaran where id_siswa='$_GET[id]'");
 $t=mysql_fetch_array($tampil);
 $cabang=mysql_query("select * from tb_alamat where id_alamat LIKE '%$t[id_alamat]%'");
 $c=mysql_fetch_array($cabang);
 $probim=mysql_query("select * from tb_program where id_program LIKE '%$t[id_program]%'");
 $p=mysql_fetch_array($probim);

?>
<?php 
echo " <table border='0' cellpadding='2' cellspacing='2' bgcolor='#FFFF66' > 
       <tr>
		<td colspan='3' align='center'><img src='../upload/".$t[photo].".jpg' width='100px' height='100px'></td>
		</tr>
	   <tr>
       <td>  No Siswa </td>
       <td>	: </td>
       <td width='355'>".$t[id_siswa]." </td>
	   </tr>
       <tr>
       <tr>
  		<td> Nama Siswa </td>
		<td>:</td>
		<td>".ucfirst($t[nama_siswa])."</td>
		</tr>
		<tr>
		<td>Jenis Kelamin </td>
		<td>:</td>
		<td>".ucfirst($t[jk])."</td>
		</tr>
		<tr>
		<td>Tempat Lahir </td>
		<td>:</td>
		<td>".ucfirst($t[tempat_lahir])."</td>
		</tr>
		<tr>
		<td>Tanggal Lahir  </td>
		<td>:</td>
		<td>".$t[tgl_lahir]."</td>
		</tr>
		<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>".$t[alamat]."</td>
		</tr>
		<tr>
		<td>Kode Pos</td>
		<td>:</td>
		<td>".$t[kode_pos]."</td>
		</tr>
		<tr>
		<td>No Telpon</td>
		<td>:</td>
		<td>".$t[no_tlp]."</td>
		</tr>
		<tr>
		<td>E-mail </td>
		<td>:</td>
		<td><a href='mailto:".$t[email]."'>$t[email]</a></td>
		</tr>
		<tr>
		<td>Asal Sekolah</td>
		<td>:</td>
		<td>".ucfirst($t[asal_sekolah])."</td>
		</tr>
		<tr>
		<td>Kelas </td>
		<td>:</td>
		<td>".$t[kelas]."</td>
		</tr> 	
		<tr>
		<td>Nama Program</td>
		<td>:</td>
		<td>".$p[nama_program]."</td>
		</tr>
		<tr>
		<td>Nama Orang Tua</td>
		<td>:</td>
		<td>".ucfirst($t[ortu])."</td>
		</tr>
		<tr>
		<td>Tempat Bimbingan </td>
		<td>:</td>
		<td>".$c[alamat]."</td>
		</tr>
		<tr>
<td>Status</td>
<td>:</td> 
<td>";
if($t[status]==0){?>
<b style="color:#F00;">Belum Konfirmasi</b>
  <?php }else{ ?>
<b style="color:#0C0;">Sudah Konfirmasi</b>	
<? } ?>
<?php
echo"</td>
</tr>
<tr>
		<td colspan='3'>&nbsp;</td>
		</tr>
<tr align='left'> 
<td colspan='3'align='center' >
<a href='?show=admin_lihat_pendaftaran.php&act=aksi_pendaftaran&id_siswa=".$t['id_siswa']."'><b>Konfirmasi</b></a> | 
<a href='admin_pendaftaran_ubah.php?id_ubah=".$t['id_siswa']."'><b>Ubah</b></a> | 
<a href='#' onClick='history.go(-1)'><b>Kembali</b></a>
</td>

</tr>
</table> 
</td>
<tr>
<td colspan='3'>&nbsp;</td>
</tr>
</table>
"; ?>

<?php 
break;
case "aksi_pendaftaran";

mysql_query("UPDATE tb_pendaftaran SET status ='1' WHERE id_siswa='$_GET[id_siswa]'");
?>
<script>window.location.href='admin_index.php?show=lihat_pendaftaran1&id=<?=$_GET[id_siswa];?>'</script>;

<?php
break; }?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>