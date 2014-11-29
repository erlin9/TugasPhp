<div id="kanan" align="justify">
<?php
  echo"<table width='100%' border='0' cellpadding='0' cellspacing='0'>
		<tr>
		<td align='center' height='30' colspan='5'><b>BUKU TAMU</b></td>
		</tr>
		<tr>
		<td colspan='5'>&nbsp;</td>
		</tr>";

	include "koneksi.php";
	
	
	
	if (($_POST[tanggal] != "") AND ($_POST[nama] != "") AND ($_POST[komentar] != "") AND ereg("^.+@.+\\..+$",$_POST[email]))
	{
			$sql="INSERT INTO tb_bukutamu (id_tamu, tgl, nama, email, komentar)
			VALUES ('".$_POST[id_tamu]."', '".$_POST[tanggal]."', '".$_POST[nama]."', '".$_POST[email]."', '".$_POST[komentar]."')";
			$hasil=mysql_query($sql);
	
echo"<tr>
	<td>&nbsp;</td>
	<td height='50' valign='top' align='center'>
		<b>Terimakasih Anda telah terpartisipasi</b><br><br>
		Anda Telah Berhasil Mengisi Buku Tamu !!!</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align='center'><a href='index.php?show=lihat_buku_tamu'><b>Tampilkan</b></a></td>
	<td>&nbsp;</td>
	</tr>";
	}
	else
	{
	 echo"<tr>
		<td>&nbsp;</td>
		<td height='50' valign='top' align='center'>Anda Belum Berhasil Mengisi Buku Tamu !!!</td>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td align='center'><a href='index.php?show=buku_tamu'><b>Kembali</b></a></td>
		<td>&nbsp;</td>
		</tr>";
	}

 echo"<tr>
	<td colspan='5'>&nbsp;</td>
	</tr>
	</table>";

?>
</div>