<div id="kanan">
<?PHP
//-------------------------admin_biaya---------------------------------
echo"	<form method='get' name='biaya'>
		<table  width='649' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>BIAYA BIMBEL GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";	
						
						echo"<table border='0' cellpadding='2' cellspacing='2'>
						<tr bgcolor='#004bab'>
									<th width=''>[Program Bimbingan]</th>
									<th width=''>[Tingkat Pendidikan]</th>
									<th width=''>[Biaya Bimbel]</th>
									<th width='140' colspan='2'>[Proses]</th>
								</tr>";
//--------------------------------------sql-----------------------------------
	$perhalaman='12';
	
	// secara default kita tampilkan 1 halaman
	$halaman = 1;
	
	$sql1="SELECT * FROM tb_biaya ORDER BY id_biaya ASC";
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
	
	$sql2="SELECT * FROM tb_biaya ORDER BY id_biaya DESC LIMIT $offset,$perhalaman";
	$hasil2=mysql_query($sql2);
		
	$no='1';	
	while ($rec2=mysql_fetch_array($hasil2))
	{
	
	
				
						
					echo"<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
						<td align='left' valign='top'>".$rec2['id_program']."</td>
						<td align='left' valign='top'>".$rec2['tingkat']."</td>
						<td align='left' valign='top'>Rp."."".$rec2['biaya']."</td>
						<td align='center' valign='top'>
						<a href='admin_biaya_ubah.php?id_ubah=".$rec2['id_biaya']."'>ubah</a> | 
						<a href='admin_biaya_hapus.php?id_hapus=".$rec2['id_biaya']."' onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a>
										
						</td>
						</tr>";
						$no++;
	}
						
					echo"	</table>";
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='center'>Halaman : ";
									for($i=1;$i<=$jumlahhalaman;$i++)
									{
										echo "[<a href='admin_index.php?show=biaya1&halaman=$i'>$i</a>]";
									}
							echo	"</td>";
						echo"	</tr>
								<tr>
									<td align='center'>Jumlah : ".$jumlah."</td>
								</tr>
								<tr>
									<td align='left'><a href='admin_biaya_tambah.php'><b>Tambah Biaya</b></a></td>
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
//205 x 154
				?>
</div>