<?php
session_start();
?>
<div id="kanan">
<?php
//-----------------------------------menu utama---------------------------
echo"	<form method='get' name='administrator'>
		<table border='0' cellpadding='0' cellspacing='0' width='649'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>ADMINISTRATOR GALILEONE</td>
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
									<th width='65'>[ID Pegawai]</th>
									<th width='70'>[Username]</th>
									<th width=''>[Password]</th>
									<th width='140' colspan='2'>[Proses]</th>
								</tr>";
								
	$sql="SELECT * FROM tb_admin";
	$hasil=mysql_query($sql);
		
	$no='1';
	while ($rec=mysql_fetch_array($hasil))
					{
		
						echo"		<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
										<td align='left'>".$rec['id_pegawai']."</td>
										<td align='left'>".$rec['username']."</td>
										<td align='left'>** ** **</td>
										<td align='center'><a href='admin_administrator_ubah.php?id_ubah=".$rec['id_admin']."'>ubah</a></td>
										<td align='center'><a href='admin_administrator_hapus.php?id_hapus=".$rec['id_admin']."'onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no++;
					}
								
					echo"	</table>";
					echo"	<br>";
					
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='left'><a href='admin_administrator_tambah.php'><b>Tambah Administrator</b></a></td>
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