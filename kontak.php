<div id="kanan" align="justify">
<center><p align="center"><h3>Alamat Cabang Galileone </h3></p></center>

<table width="560" bgcolor="#FFFF66" align="center" style="border-bottom:#FFF solid ">
<tr bgcolor="#FFFFFF" style="font-size:12px">
<td width="28" align="center"><b>Cabang</b></td>
<td width="224" align="center"><b>Alamat</b></td>
<td width="150" align="center"><b>No Telpon  /  HP</b></td>
</tr>
<?php 
include ('koneksi.php');
$lokasi=mysql_query("SELECT * FROM tb_alamat");
while ($lok=mysql_fetch_array($lokasi)){
?>
<tr>
<td width="28" ><? echo"$lok[id_alamat]";?></td>
<td width="234"><? echo"$lok[alamat]";?></td>
<td width="152"><? echo"$lok[tlp]";?>&nbsp;/&nbsp;<? echo"$lok[hp]";?></td>
</tr>

<? } ?>
</table>
<br/>
</div>


