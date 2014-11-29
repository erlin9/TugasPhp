<div id="kanan" align="justify">
<?php
	include ('koneksi.php'); 
	extract($_GET);
	$sql="SELECT * FROM tb_berita WHERE id_berita='".$id_berita."'";
	$hasil=mysql_query($sql);
	$rec=mysql_fetch_array($hasil);

					echo"<table width='100%' border=0 cellpadding=0 cellspacing=0  >
					<tr>
					<td align='center' height='30' colspan='5'><b>BERITA</b></td>
					</tr>
					<tr>
						<td colspan='5'>&nbsp;</td>
					</tr>
					<input type='hidden' name='id_berita_nya' value='$id_berita'></input>
					<tr>
						<td width='5'>&nbsp;</td>
						<td colspan='3'><font size='3' color='#004bab'> ".$rec['judul']."</font></td>
						<td width='5'>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan='3'><font size='1'><i>".$rec['tgl']."</i></font></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Sumber&nbsp;:&nbsp;".$rec['sumber']."</td>
						
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan='3'><p align='justify'>".$rec['isi']." </p></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='5'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='5' align='right'>
						<input name='btnBack' type='button' id='tbox' value='Kembali'  onClick=\"window.history.back();\"/>
						</td>
					</tr>
					<tr>
						<td colspan='5'>&nbsp;</td>
					</tr>
				</table>";
?>			
</div>