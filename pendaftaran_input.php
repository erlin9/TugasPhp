<style type="text/css">
<!--
.style3 {font-size: 10px}
.style4 {font-size: 14px}
-->
    </style>
<div id="kanan" align="justify"><center><h3><b>Formulir Pendaftaran</b></h3></center>
<form id="identitasForm" name='pendaftaran_input' action='pendaftaran_simpan.php' method='post' enctype="multipart/form-data">
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
	
    <tr>
	<td colspan='5'>
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
    </td>
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Nama</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="text" name="nama" class="required"  title="NAMA harus diisi"  /></td>
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
    <td width='70%' align='left' valign='top'><input value="" name="tgl_lahir" class="validate[required] picker" type="text" title="TANGGAL LAHIR harus diisi"/> </td>
    <td width='5'>&nbsp;</td>
    </tr>
	<tr>
	<td>&nbsp;</td>
	<td align='left' valign='top'>Alamat Rumah/Kos</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><textarea name='alamat' rows='3' cols='25' class="required" title="ALAMAT harus diisi"></textarea></td>
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
	<td align='left' valign='top'><input type="text" name="nohp"  class="required"  title="NO TELPON harus diisi"  /></td>
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
     <select class="required" name="kelas" title="KELAS harus dipilih">
          <option value="">-Pilih Kelas-</option>
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
    <select class="required" name="nama_program" title="PROGRAM harus dipilih">
          <option value="">-Pilih Program Bimbingan-</option>
          <?php $probim=mysql_query("SELECT * FROM tb_program ORDER BY nama_program ASC");
		  		while($pr=mysql_fetch_array($probim)){?>
          <option value="<?=$pr[id_program];?>"><?=$pr[nama_program];?></option>
          <? } ?>
    </select>
    </td>
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
    <select class="required" name="tempat_bimbingan" title="TEMPAT harus dipilih">
          <option value="required">-Pilih Lokasi- </option>
         <?php $tmpt=mysql_query("SELECT * FROM tb_alamat ORDER BY id_alamat ASC");
		  		while($tmp=mysql_fetch_array($tmpt)){?>
          <option value="<?=$tmp[id_alamat];?>"><?=$tmp[id_alamat];?></option>
          <? } ?>
     </select>
    </select>
    </td>
    <td>&nbsp;</td>
	</tr>
    
    <tr>
	<td>&nbsp;</td>
    <td align='left' valign='top'>Photo</td>
	<td align='left' valign='top'>:</td>
	<td align='left' valign='top'><input type="file" name="photo" class="required"  title="PHOTO belum dipilih"/> *<span class="style3">Ukuran max. 500-1000kb</span></td>
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
	</tr>
	</table>
	</form></br>
</div>


