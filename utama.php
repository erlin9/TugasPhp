<div id="tengah" align="center"> >>Berita<< </div>
<div id="bawah">
<?php 
$berita = mysql_query("select * from tb_berita ORDER BY id_berita limit 3");
while ($br=mysql_fetch_array($berita)){
	
	//banyaknya potongan
		$potong=15;
	//ambil isi berita singkat		
		$recordsingkat=$br['isi'];
		$tmppotongan=array();
		$tmp = explode(" ",$recordsingkat);
		for($i=0;$i<=$potong;$i++)
		{
			$tmppotongan[$i]=$tmp[$i];
		}
		$bagian=implode(" ",$tmppotongan);
		
?>
<table width="850px" border="0" cellpadding='0' cellspacing='0'>
  <tr>
    <td width="80" height="70px" rowspan="4"><img src="upload/<? echo"$br[photo]";?>.jpg" width="70" height="70"  border='2' alt="berita"></td>
    <td width="97"><i> Created Date :</i></td>
    <td width=""><i><? echo"$br[tgl]";?></i></td>
  </tr>
  <tr>
    <td colspan="2"><? echo"$br[sumber]";?></td>
  </tr>
  <tr>
    <td colspan="2"><font color="#004bab" size="3"><? echo"$br[judul]";?></font></td>
  </tr>
  <tr>
    <td colspan="2"><? echo"$bagian...
	<a href='?show=pilihan_berita&id_berita=".$br['id_berita']."'>
	<font size='2'>[selengkapnya]</font></a>";?><br></td>
  </tr>
</table><br />
<? } ?>
<a href='?show=berita'><p align="right">Berita Lainnya...</p></a>
</div>
</div>