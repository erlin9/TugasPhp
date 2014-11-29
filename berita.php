<div id="kanan" align="justify">
<?php
//-------------------------berita---------------------------------

echo "	<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='center'  height='30' colspan='4'><b>BERITA</b></td>
					</tr>
					<tr>
						<td colspan='4'>&nbsp;</td>
					</tr>";
//----------------------------------sql------------------------------
	include "koneksi.php";
	
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
		

	while ($rec2=mysql_fetch_array($hasil2))
	{


		//banyaknya potongan
		$potong=15;
		//ambil isi berita singkat		
		$recordsingkat=$rec2['isi'];
		$tmppotongan=array();
		$tmp = explode(" ",$recordsingkat);
		for($i=0;$i<=$potong;$i++)
		{
			$tmppotongan[$i]=$tmp[$i];
		}
		$bagian=implode(" ",$tmppotongan);
		
	echo "	<tr>
						<td width='5'>&nbsp;</td>
						<td width='100' height='90' align='center' valign='top' rowspan='3'>
						<img src='upload/".$rec2['photo'].".jpg' width='90' height='80' alt='".$rec2['photo']."' border='2'></a></td>
						<td width='500'><font size='4' color='#004bab'>".$rec2['judul']."</font><br>
										<font size='1'><i>".$rec2['tgl']."</i></font><br>
										<font size='1'><i>".$rec2['sumber']."</i></font>
										</td>
						<td>&nbsp;</td>
					</tr>
					<tr >
						<td>&nbsp;</td>
						<td width='500' align='justify'>
							$bagian...
							<a href='?show=pilihan_berita&id_berita=".$rec2['id_berita']."'><font size='2' ><b>[selengkapnya]</b></font></a>
						<td></td>
						</tr>
					<tr>
						<td>&nbsp;</td>
						<td><hr></td>
						<td>&nbsp;</td>
					</tr>";

	}
	echo"	<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>";
	echo"	<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align='center'>Halaman : ";
						for($i=1;$i<=$jumlahhalaman;$i++)
							{
								echo "[<a href='?show=berita&halaman=$i'>$i</a>]";
							}
		echo"	</td>
						<td>&nbsp;</td>
					</tr>";
	echo"	<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align='center'>Jumlah : ".$jumlahberita."</td>
						<td>&nbsp;</td>
					</tr>";
					
	echo"	<tr>
						<td colspan='5'>&nbsp;</td>
					</tr>
				</table>";
?>

</div>
