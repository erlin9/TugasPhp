<div id="kanan">
<?php
//-----------------------------------menu utama---------------------------
echo"	<form method='get' name='try_out'>
		<table border='0' cellpadding='0' cellspacing='0' width='649'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>HASIL TRY OUT GALILEONE</td>
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
									<th width='65'>[No Siswa]</th>
									<th width='175'>[Nama]</th>
									<th width='50'>[Kelas]</th>
									<th width='170'>[Asal Sekolah]</th>
									<th width=''>[Skor]</th>
									<th width='140' colspan='2'>[Proses]</th>
								</tr>";
	$perhalaman='12';
	
	// secara default kita tampilkan 1 halaman
	$halaman = 1;
	
	$sql="SELECT * FROM tb_to";
	$hasil1=mysql_query($sql);
	$jumlahhalaman = ceil(mysql_num_rows($hasil1)/$perhalaman);
	$jumlah = mysql_num_rows($hasil1);
	
	// if $_GET['page'] didapatkan, digunakan ini sebagai no halaman/page
	if(isset($_GET['halaman']))
	{
    $halaman = $_GET['halaman'];
	}

	// hitung banyaknya offset
	$offset = ($halaman - 1) * $perhalaman;
	
	$sql2="SELECT * FROM tb_to ORDER BY id_to DESC LIMIT $offset,$perhalaman";
	$hasil2=mysql_query($sql2);
		
	$no='1';	
	while ($rec2=mysql_fetch_array($hasil2))
	{
		
						echo"		<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
										<td align='left'>".$rec2['id_siswa']."</td>
										<td align='left'>".$rec2['nama_siswa']."</td>
										<td align='left'>".$rec2['kelas']."</td>
										<td align='left'>".$rec2['asal_sekolah']."</td>
										<td align='left'>".$rec2['skor']."</td>
										<td align='center'><a href='admin_tryout_ubah.php?id_ubah=".$rec['id_to']."'>ubah</a></td>
										<td align='center'><a href='admin_tryout_hapus.php?id_hapus=".$rec['id_to']."'onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
						$no++;
					}
					echo"	</table>";
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='center'>Halaman : ";
									for($i=1;$i<=$jumlahhalaman;$i++)
									{
										echo "[<a href='admin_index.php?show=tryout&halaman=$i'>$i</a>]";
									}
							echo	"</td>";
						echo"	</tr>
								<tr>
									<td align='center'>Jumlah : ".$jumlah."</td>
								</tr>
					
					           <tr>
									<td align='left'><a href='admin_tryout_tambah.php'><b>Tambah</b></a></td>
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