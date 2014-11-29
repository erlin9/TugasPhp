<?php
session_start();
?>
<div id="kanan">
<?php
//-------------------------admin_sejarah---------------------------------
echo"	<form method='get' name='sejarah'>
		<table width='650' border='0' cellpadding='0' cellspacing='0'>
					<tr>
					<td align='center' bgcolor='#004bab' height='30'  colspan='3' class='k2'>SEJARAH GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='600' border='0' cellpadding='2' cellspacing='2'>
								<tr bgcolor='#004bab'>
								<th width='100'>[Photo]</td>
									<th width='360'>[Sejarah]</td>
									<th width='140' colspan='2'>[Proses]</td>
								</tr>";
								
//------------------------------sql---------------------------------
	include ('../koneksi.php');
	$sql="SELECT * FROM tb_sejarah";
	$hasil=mysql_query($sql);
		
	$no='1';
	while ($rec=mysql_fetch_array($hasil))
					{
		
						echo"<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
						<td align='left'><img src='../upload/".$rec['photo'].".jpg' width='80px' height='80px'> </td>
						<td align='justify'>".$rec['sejarah']."</td>
						<td align='center'><a href='admin_sejarah_ubah.php?id_ubah=".$rec['id_sejarah']."'>ubah</a></td>
						<td align='center'><a href='admin_sejarah_hapus.php?id_hapus=".$rec['id_sejarah']."&amp;gambar=".$rec['photo']."' onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no++;
					}
								
					echo"	</table>";
					echo"	<br>";
					
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='left'><a href='admin_sejarah_tambah.php'><b>Tambah Sejarah</b></a></td>
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
</div>
