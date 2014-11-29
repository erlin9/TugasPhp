<?php
session_start();
?>
<div id="kanan">
<?php
//-----------------------------------menu utama---------------------------
echo"	<form method='get' name='visi_misi'>
		<table  border='0' cellpadding='0' cellspacing='0' width='650' >
					<tr>
						<td align='center' bgcolor='#004bab'  height='30' colspan='3' class='k2'>VISI DAN MISI GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";
							
//------------------------------------visi---------------------------------							
					echo"	<table  border='0' cellpadding='2' cellspacing='2'>
								<tr bgcolor='#004bab'>
									<th width=''>[Visi]</td>
									<th width='' colspan='2'>[Proses]</td>
								</tr>";
								
	$sql="SELECT * FROM tb_visi";
	$hasil=mysql_query($sql);
		
	$no='1';
	while ($rec=mysql_fetch_array($hasil))
					{
		
						echo"		<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
										<td align='justify' >".$rec['isi']."</td>
										<td align='center'><a href='admin_visi_ubah.php?id_ubah_visi=".$rec['id_visi']."'>ubah</a></td>
										<td align='center'><a href='admin_visi_hapus.php?id_hapus_visi=".$rec['id_visi']."'onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no++;
					}
								
					echo"	</table>";
					echo"	<br>";
					
					echo" <table align='left' width='' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td ><a href='admin_visi_tambah.php'><b>Tambah Visi</b></a></td>
								</tr>
							</table>";
							
					echo"<br><br>";
//------------------------------------misi---------------------------------							
					echo"	<table width='' border='0' cellpadding='2' cellspacing='2'>
								<tr bgcolor='#004bab'>
									<th width=''>[Misi]</td>
									<th width='' colspan='2'>[Proses]</td>
								</tr>";
								
	$sql2="SELECT * FROM tb_misi";
	$hasil2=mysql_query($sql2);
		
	$no2='1';
	while ($rec2=mysql_fetch_array($hasil2))
					{
		
						echo"		<tr bgcolor=#".($no2 % 2 ?"FFFF66":"FFFF96").">
										<td>".$rec2['isi']."</td>
										<td align='center'><a href='admin_misi_ubah.php?id_ubah_misi=".$rec2['id_misi']."'>ubah</a></td>
										<td align='center'><a href='admin_misi_hapus.php?id_hapus_misi=".$rec2['id_misi']."'onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no2++;
					}
								
					echo"	</table>";
					echo"	<br>";
					
					echo" <table align='left' width='' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td ><a href='admin_misi_tambah.php'><b>Tambah Misi</b></a></td>
								</tr>
							</table>";							
							
					
					echo"</td>
						<td width='5'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
				</table>
				</form>";
				?>
</div>