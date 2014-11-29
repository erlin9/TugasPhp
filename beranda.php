<div id="kanan">
<?php 
$visi = mysql_query("select * from tb_visi");
while ($vs = mysql_fetch_array($visi)){
?>
<p align="justify"> 
<? echo"$vs[isi]";?></p>
<? } ?>
<?php 
$misi = mysql_query("select * from tb_misi");
while ($ms=mysql_fetch_array($misi)){
?>
<p align="justify"> 
<? echo"$ms[isi]";?></p>
<? } ?>
</div>
