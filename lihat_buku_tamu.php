<div id="kanan" align="justify">
<?php
//-------------------------buku tamu---------------------------------

echo"	<table width='100%' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center'  height='30' colspan='3'><b>LIHAT BUKU TAMU</b></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='left'>
							<a href='?show=buku_tamu'><b>Tambah Komentar</b></a>
							<br><hr>
						</td>
						<td width='5'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td width='100%'>";
			echo"	<table width='100%' border='0' cellpadding='2' cellspacing='2' >";
								
//----------------------------sql-----------------------------------
	include "koneksi.php";
	
	$perhalaman='5';
	
	// secara default kita tampilkan 1 halaman
	$halaman = 1;
	
	$sql1="SELECT * FROM tb_bukutamu ORDER BY id_tamu ASC";
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
	
	$sql2="SELECT * FROM tb_bukutamu ORDER BY id_tamu DESC LIMIT $offset, $perhalaman";
	$hasil2=mysql_query($sql2);
	
	while ($rec2=mysql_fetch_array($hasil2))
	{
				echo"	<tr >
									<td align='left' valign='top'>Tanggal</td>
									<td align='left' valign='top'>:</td>
									<td width='100%'>".$rec2['tgl']."</td>
								</tr>
								<tr>
									<td align='left' valign='top'>Nama</td>
									<td align='left' valign='top'>:</td>
									<td width='100%'><b>".$rec2['nama']."</b></td>
								</tr>
								<tr>
									<td align='left' valign='top'>Email</td>
									<td align='left' valign='top'>:</td>
									<td width='100%'><a href='mailto:".$rec2['email']."'><b>".$rec2['email']."</b></a></td>
								</tr>
								<tr>
									<td align='left' valign='top'>Komentar</td>
									<td align='left' valign='top'>:</td>
									<td width='100%'>".$rec2['komentar']."</td>
								</tr>
								<tr>
									<td colspan='3'><hr></td>
								</tr>";
								
	}
	
				echo"	<tr>
									<td colspan='3' align='center'>Halaman : ";
							
							for($i=1;$i<=$jumlahhalaman;$i++)
							{
								echo "[<a href='?show=lihat_buku_tamu&halaman=$i'>$i</a>]";
							}
				echo"	</td>
								</tr>";
				echo"	<tr>
									<td colspan='3' align='center'>Jumlah : ".$jumlahberita."</td>
								</tr>";
				echo"	<tr>
									<td colspan='3' align='left'><a href='?show=buku_tamu'><b>Tambah Komentar</b></a></td>
								</tr>
							</table>";
		echo"	</td>
						<td width='5'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>	
				</table>";
?>
</div>