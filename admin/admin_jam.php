<div id="kanan">
<?php
//-------------------------admin_jam---------------------------------
echo"	<form method='get' name='jam'>
		<table width='649' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>JAM BIMBINGAN GALILEONE</td>
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
									<th width='460'>[Jam Bimbingan]</td>
									<th width='140' colspan='2'>[Proses]</td>
								</tr>";
								
	$sql="SELECT * FROM tb_jam";
	$hasil=mysql_query($sql);
		
	$no='1';
	while ($rec=mysql_fetch_array($hasil))
					{
		
						echo"		<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
										<td align='left'>".$rec['jam']."</td>
										<td align='center'><a href='admin_jam_ubah.php?id_ubah_jam=".$rec['id_jam']."'>ubah</a></td>
										<td align='center'><a href='admin_jam_hapus.php?id_hapus_jam=".$rec['id_jam']."'onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no++;
					}
								
					echo"	</table>";
					echo"	<br>";
					
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='left'><a href='admin_jam_tambah.php'><b>Tambah</b></a></td>
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