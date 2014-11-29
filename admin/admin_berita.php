<div id="kanan">
<?PHP
//-------------------------admin_berita---------------------------------
echo"	<form method='get' name='berita'>
		<table  width='649' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>BERITA GALILEONE</td>
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
	
	$sql1="SELECT * FROM tb_berita ORDER BY id_berita ASC";
	$hasil1=mysql_query($sql1);
	$jumlahhalaman = ceil(mysql_num_rows($hasil1)/$perhalaman);
	$jumlahberita = mysql_num_rows($hasil1);
	
	// if $_GET['page'] didapatkan, digunakan ini sebagai no halaman/page
	if(isset($_GET['halaman']))
	{
    $halaman = $_GET['halaman'];
	}

	// hitung banyaknya offset
	$offset = ($halaman - 1) * $perhalaman;
	
	$sql2="SELECT * FROM tb_berita ORDER BY id_berita DESC LIMIT $offset,$perhalaman";
	$hasil2=mysql_query($sql2);
		
	$no='1';	
	while ($rec2=mysql_fetch_array($hasil2))
	{
	
	
				echo"<table border='0' cellpadding='2' cellspacing='2' bgcolor=#".($no % 2 ?"FFFF66":"FFFF96")." >
						<tr>
										<td rowspan='4' width='154' height='115' align='center'>
										<img src='../upload/".$rec2['photo'].".jpg' width='100' height='108' alt='".$rec2['photo']."' border='2'>                                        </td>
										<td width='80' align='left' valign='top'>Tanggal</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top' width='400'>".$rec2['tgl']."</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Judul</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>".$rec2['judul']."</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Sumber</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>".$rec2['sumber']."</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Isi Berita</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>".substr($rec2['isi'],0,150)."<font color='#004bab'>...</font>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align='right' valign='top'>
											<a href='admin_berita_ubah.php?id_ubah=".$rec2['id_berita']."&amp;gambar=".$rec2['photo']."'>ubah</a> | 
											<a href='admin_berita_hapus.php?id_hapus=".$rec2['id_berita']."&amp;gambar=".$rec2['photo']."' onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
									</tr>";
									$no++;
	}
						
					echo"	</table>";
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='center'>Halaman : ";
									for($i=1;$i<=$jumlahhalaman;$i++)
									{
										echo "[<a href='admin_index.php?show=berita1&halaman=$i'>$i</a>]";
									}
							echo	"</td>";
						echo"	</tr>
								<tr>
									<td align='center'>Jumlah Berita : ".$jumlahberita."</td>
								</tr>
								<tr>
									<td align='left'><a href='admin_berita_tambah.php'><b>Tambah Berita</b></a></td>
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