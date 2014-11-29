<div id="kanan">
<?php
//-------------------------admin_probim---------------------------------
echo"	<form method='get' name='probim'>
		<table width='649' border='0' cellpadding='0' cellspacing='0'>
					<tr>
					<td align='center' bgcolor='#004bab' height='30' width='700' colspan='3' class='k2'>PROGRAM BIMBINGAN GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='600' border='0' cellpadding='2' cellspacing='2'>
								<tr bgcolor='#004bab'>
								<th width='110'>[Nama Program]</th>
									<th width='360'>[Deskripsi]</th>
									<th width='140' colspan='2'>[Proses]</th>
								</tr>";
								
//------------------------------sql---------------------------------
	include ('../koneksi.php');
	$perhalaman='1';
	
	// secara default kita tampilkan 1 halaman
	$halaman = 1;
	
	$sql1="SELECT * FROM tb_program ORDER BY id_program";
	$hasil1=mysql_query($sql1);
	$jumlahhalaman = ceil(mysql_num_rows($hasil1)/$perhalaman);
	$jumlah = mysql_num_rows($hasil1);
	
	// if $_GET['page'] didapatkan, digunakan ini sebagai no halaman/page
	if(isset($_GET['halaman']))
	{
    $halaman = $_GET['halaman'];
	}

	// hitung banyaknya offset
	$offset = ($halaman - 1) * $perhalaman;
	
	$sql2="SELECT * FROM tb_program ORDER BY id_program DESC LIMIT $offset,$perhalaman";
	$hasil2=mysql_query($sql2);
		
	$no='1';	
	while ($rec2=mysql_fetch_array($hasil2))
	{
		
						echo"<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
						<td align='left'>".$rec2['nama_program']."</td>
						<td align='justify'>".$rec2['deskripsi']."</td>
						<td align='center'><a href='admin_probim_ubah.php?id_ubah_probim=".$rec2['id_program']."'>ubah</a></td>
						<td align='center'><a href='admin_probim_hapus.php?id_hapus=".$rec2['id_program']."' onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no++;
					}
								
					echo"	</table>";
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='center'>Halaman : ";
									for($i=1;$i<=$jumlahhalaman;$i++)
									{
										echo "[<a href='admin_index.php?show=probim1&halaman=$i'>$i</a>]";
									}
							echo	"</td>";
						echo"	</tr>
								<tr>
									<td align='center'>Jumlah : ".$jumlah."</td>
								</tr>
								<tr>
									<td align='left'><a href='admin_probim_tambah.php'><b>Tambah Program</b></a></td>
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
