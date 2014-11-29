<?php 
include "koneksi.php";
	$sql="SELECT * FROM tb_pendaftaran WHERE id_siswa='".$_GET[id]."'";
	$hasil=mysql_query($sql);
	$rec=mysql_fetch_array($hasil);
		

echo " <form method='get'>  
		<table width='448' border='0' cellpadding='0' cellspacing='0' align='center'>
       <input type='hidden' name='id_siswa_nya' value='$id_siswa'></input>
		<tr>
		<td align='center' height='128' colspan='5' background='gambar/simbol_putih.jpg'></td>
		</tr>
		<tr>
		<td colspan='5'>&nbsp;</td>
		</tr>
        <tr>
	   <td width='5'>&nbsp;</td>
    
	  <td width='439' height='50' valign='top'>
		<b>Terimakasih</b><br>
		<p> Nomor Siswa : ".$rec['id_siswa']." </p>
		<p> Nama Siswa : ".$rec['nama_siswa']." </p><br>
		<p align='justify'>Anda telah terdaftar sebagai siswa Lembaga Bimbingan Belajar Galileone, untuk validasi data yang anda kirim, silahkan menghubungi kantor cabang.</p><br/><br/>
      <a href='pendaftaran_pdf.php?id=".$rec['id_siswa']."'>
								<img src='./gambar/icon_pdf.gif' height='20' width='20' border='1'/>
								CETAK
							</a>
      </td>
	<td width='4'>&nbsp;</td>
	</tr>
	
	<tr>
	<td>&nbsp;</td>
	<td align='center'><a href='index.php?show=pendaftaran'><b>TUTUP</b></a></td>
	<td>&nbsp;</td>
	</tr>
    </table>
	</form>";
	?>