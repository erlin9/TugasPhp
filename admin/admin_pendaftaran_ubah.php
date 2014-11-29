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

//-----------------------------------menu utama
echo "<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=pendaftaran1'><b>Admin Pendaftaran</b></a> | Admin Pendaftaran Ubah";
//-------------------------admin_galeri---------------------------------

echo"	<form enctype='multipart/form-data' method='post' action='admin_pendaftaran_ubah_nya.php'>
		<input type='Hidden' name='MAX_FILE_SIZE' value='100000000' />
		<table width='100%' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2' ><b>PENDAFTARAN GALILEONE</b></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";
						
		include "../koneksi.php";
		
		$sql="SELECT * FROM tb_pendaftaran WHERE id_siswa='".$_GET[id_ubah]."'";
		$hasil=mysql_query($sql);
		
		while($rec=mysql_fetch_array($hasil))	
		{
		
						echo "
						<input type='hidden' name='id' value='".$rec['id_siswa']."'></input>
						<input type='hidden' name='hiddenphoto' value='".$rec['photo']."' />";
						
						echo " <table width='400' border='0' cellpadding='2' cellspacing='2' bgcolor='#FFFF66'>
									<tr>
										<td  align='left' valign='top'>Nama Siswa</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>
										<input type='text' class='validate[required]' name='nama' value='".$rec['nama_siswa']."' size='30' maxlength='50'/>
										</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Jenis Kelamin</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>";?>
	<input type="radio" id="jeniskelamin1" name="jeniskelamin" value="laki-laki" class="validate[required] radio" 
	<?php if($rec['jk']=='laki-laki'){?> checked="checked" <? } ?>/>laki - laki
	<input type="radio" id="jeniskelamin2" name="jeniskelamin" value="perempuan" class="validate[required] radio" 
    <?php if($rec['jk']=='perempuan'){?> checked="checked" <? } ?>/>perempuan
      							<?php echo"
										</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Tempat Lahir</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='tempat_lahir' size='30' value='".$rec['tempat_lahir']."' /></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Tanggal Lahir</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' class='validate[required] picker' name='tgl_lahir' value='".$rec['tgl_lahir']."' size='30' maxlength='50'/></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Alamat</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><textarea name='alamat' rows='3' cols='25'>".$rec['alamat']."</textarea ></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Kodepos</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='kodepos' size='30' value='".$rec['kode_pos']."' /></td>
									</tr>
									<tr>
										<td align='left' valign='top'>No Telpon/Hp</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='no_tlp' size='30' value='".$rec['no_tlp']."' /></td>
									</tr>
									<tr>
										<td align='left' valign='top'>E-mail</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='email' size='30' value='".$rec['email']."' /></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Asal Sekolah</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='asal_sekolah' size='30' value='".$rec['asal_sekolah']."' /></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Kelas</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>";?>
										<select class="required" name="kelas">
         								<option value="">- Pilih Kelas-</option>
         								<?php $kls=mysql_query("SELECT DISTINCT(tingkat) FROM tb_biaya ORDER BY tingkat ASC");
		  									while($kl=mysql_fetch_array($kls)){?>
         <option value="<?=$kl[tingkat];?>" <?php if($kl[tingkat]==$rec[kelas]){?> selected="selected" <? } ?>><?=$kl[tingkat];?></option>
          								<? } ?>
     									</select>
                                        
                                        <?php echo"</td>
									
                                    </tr>
									<tr>
										<td align='left' valign='top'>Program Bimbingan</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>";?>
                                        
   <select class="" name="nama_program">
   <option value="">- Pilih Program Bimbingan -</option>
   <?php $probim=mysql_query("SELECT * FROM tb_program ORDER BY nama_program ASC");
	while($pr=mysql_fetch_array($probim)){?>
   <option value="<?=$pr[id_program];?>" <?php if($pr[id_program]==$rec[id_program]){?> selected="selected" <? } ?>><?=$pr[nama_program];?></option>
     <? } ?>
   </select>
										
										<?php echo"</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Nama Orang Tua</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='ortu' size='30' value='".$rec['ortu']."' /></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Alamat Cabang</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>";?>
										
										 <select class="" name="tempat_bimbingan">
          <option value="">- Pilih Lokasi - </option>
          <?php $tmpt=mysql_query("SELECT * FROM tb_alamat ORDER BY id_alamat ASC");
		  		while($tmp=mysql_fetch_array($tmpt)){?>
          <option value="<?=$tmp[id_alamat];?>"  <?php if($tmp[id_alamat]==$rec[id_alamat]){?> selected="selected" <? } ?>><?=$tmp[id_alamat];?></option>
          <? } ?>
          </select>
									<?php echo"	</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Foto</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>
										<input type='hidden' name='hiddenphoto' value='".$rec['photo']."'>
							            <img src='../upload/".$rec['photo'].".jpg' width='80px' height='80px' ><br />
							            <p><b>".$rec['photo']."</b>.jpg</p>
										</td>
									</tr>
									<tr>
									<td width='100' valign='top' align='left'>Ubah Photo&nbsp</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='file' name='photo' size='30'/></td>
								</tr>
									<tr>
										<td align='right' colspan='3'>&nbsp;</td>
									</tr>";
		}
							echo"	<tr>
										<td align='right' colspan='3'><input type='submit' value='Simpan'  name='edit_photo'></td>
									</tr>
								</table>
						</td>
						<td width='5'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
				</table>
				</form>";				
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>