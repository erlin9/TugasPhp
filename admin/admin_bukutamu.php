<div id="kanan">
<?PHP
//-------------------------admin_galeri---------------------------------
echo"	<form method='get' name='bukutamu'>
		<table  width='649' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>BUKU TAMU GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";	
//--------------------------------------sql-----------------------------------
	
	
	$perhalaman='5';
	
	// secara default kita tampilkan 1 halaman
	$halaman = 1;
	
	$sql1="SELECT * FROM tb_bukutamu ORDER BY id_tamu ASC";
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
	
	$sql2="SELECT * FROM tb_bukutamu ORDER BY id_tamu DESC LIMIT $offset,$perhalaman";
	$hasil2=mysql_query($sql2);
		
	$no='1';	
	while ($rec2=mysql_fetch_array($hasil2))
	{
	
	
				echo"<table  width='640' border='0' cellpadding='2' cellspacing='2' bgcolor=#".($no % 2 ?"FFFF66":"FFFF96")." >
						<tr>
										<td width='80' align='left' valign='top'>Tanggal</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top' width='400'>".$rec2['tgl']."</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Nama</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>".$rec2['nama']."</td>
									</tr>
									<tr>
										<td align='left' valign='top'>E-mail</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><a href='mailto:".$rec2['email']."'>$rec2[email]</a></td>
									</tr>
									<tr>
										<td align='left' valign='top'>Isi Komentar</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>".$rec2['komentar']."</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align='right' valign='top'>
										<a href='admin_bukutamu_hapus.php?id_hapus=".$rec2['id_tamu']."' onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
										<td>&nbsp;</td>
									</tr>";
									$no++;
	}
						
					echo"	</table>";
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='center'>Halaman : ";
									for($i=1;$i<=$jumlahhalaman;$i++)
									{
										echo "[<a href='admin_index.php?show=bukutamu1&halaman=$i'>$i</a>]";
									}
							echo	"</td>";
						echo"	</tr>
								<tr>
									<td align='center'>Jumlah Bukutamu : ".$jumlah."</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
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