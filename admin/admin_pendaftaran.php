<div id="kanan">
<?PHP
//-------------------------admin---------------------------------
echo"	<form method='get' name='pendaftaran'>
		<table width='649' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>DATA PENDAFTAR BIMBEL GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";
						
											
//--------------------------------------sql-----------------------------------
	
	
	$perhalaman='7';
	
	// secara default kita tampilkan 1 halaman
	$halaman = 1;
	
	$sql1="SELECT * FROM tb_pendaftaran ORDER BY id_siswa ASC";
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
	echo"
	<form method='get' action=''/>
	<input name='show' value='pendaftaran1' type='hidden'/>
	Masukkan No Siswa/Nama :
	<input name='query' value='".$_REQUEST['query']."' type='text'/>
	<select class='' name='nama_program'>
          <option>Pilih Program Bimbingan</option>";
          $probim=mysql_query("SELECT * FROM tb_program ORDER BY nama_program ASC");
		  while($pr=mysql_fetch_array($probim)){?>
          <option value="<?=$pr[id_program];?>" <?php if($pr[id_program]==$_REQUEST[nama_program]){?> selected="selected" <? } ?>><?=$pr[nama_program];?></option>
          <? } ?>
    </select>
	<input name="submit" value="cari" type="submit"/>
	</form>
<?php echo"	
	<table width='642' border='0' cellpadding='2' cellspacing='2'>
						<tr bgcolor='#004bab'>
										<th align='center' valign='top'>[No Siswa]</b></th>
										<th align='center' valign='top'>[Nama Siswa]</th>
										<th align='center' valign='top'>[Asal Sekolah]</th>
										<th align='center' valign='top'>[Kelas]</th>
										<th align='center' valign='top'>[Program Bimbel]</th>
										<th align='center' valign='top'>[Status]</th>
										<th align='center' valign='top'>[Proses]</th>
									</tr>";
if($_GET['query']!=""){
	$sql2="SELECT * FROM tb_pendaftaran WHERE 
	id_siswa LIKE '%$_GET[query]%' OR
	nama_siswa LIKE '%$_GET[query]%'
	ORDER BY id_siswa DESC LIMIT $offset,$perhalaman";
}elseif($_GET['nama_program']!=""){
$sql2="SELECT * FROM tb_pendaftaran WHERE
	id_program = '$_GET[nama_program]' 
	ORDER BY id_siswa DESC LIMIT $offset,$perhalaman";
}else{
	$sql2="SELECT * FROM tb_pendaftaran ORDER BY id_siswa DESC LIMIT $offset,$perhalaman";
}
	$hasil2=mysql_query($sql2);
		
	$no='1';	
	while ($rec2=mysql_fetch_array($hasil2))
	{
	$program=mysql_query("SELECT * FROM tb_program where id_program='".$rec2['id_program']."'");
	$p=mysql_fetch_array($program);
	
										echo"<tr bgcolor=#".($no % 2 ?"FFFF66":"FFFF96").">
			<td align='left' valign='top'><a href='admin_lihat_pendaftaran.php?id=".$rec2['id_siswa']."'><b><small>".$rec2['id_siswa']."</small></b></a></td>
										<td align='left' valign='top'>".$rec2['nama_siswa']."</td>
										<td align='left' valign='top'>".$rec2['asal_sekolah']."</td>
										<td align='left' valign='top'>".$rec2['kelas']."</td>
										<td align='left' valign='top'>".$p['nama_program']."</td>
										<td align='left' valign='top'>";
										if($rec2['status']==0){ ?>
										<b style="color:#F00;">Belum Konfirmasi</b>
                                        <?php }else{ ?>
										<b style="color:#0C0;">Sudah Konfirmasi</b>	
										<? }
										echo"</td>
										<td align='left' valign='top'> 
										<a href='admin_pendaftaran_ubah.php?id_ubah=".$rec2['id_siswa']."&amp;gambar=".$rec2['photo']."'>ubah</a> | 
										<a href='admin_pendaftaran_hapus.php?id_hapus=".$rec2['id_siswa']."&amp;gambar=".$rec2['photo']."' onClick=\"return confirm('Konfirmasi Proses Hapus : Anda Yakin Untuk Menghapus Data Ini !!! ')\">hapus</a></td>
										
									</tr>
									
									";
									$no++;
	}
						
					echo"	</table>";
					echo" <table width='600' border='0' cellpadding='0' cellspacing='0'>
								<tr>
									<td align='center'>Halaman : ";
									for($i=1;$i<=$jumlahhalaman;$i++)
									{
										echo "[<a href='admin_index.php?show=pendaftaran1&halaman=$i'>$i</a>]";
									}
							echo	"</td>";
						echo"	</tr>
								<tr>
									<td align='center'>Jumlah Siswa : ".$jumlah."</td>
								</tr>
								<tr>
									<td align='left'><a href='admin_pendaftaran_tambah.php'><b>Tambah</b></a></td>
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