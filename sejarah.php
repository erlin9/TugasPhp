<div id="kanan" align="justify"><center><h3>Sejarah Galileone</h3></center>
<?php 
$sejarah = mysql_query("select * from tb_sejarah");
$sj=mysql_fetch_array($sejarah);
?><br />

<table align="center"  cellpadding="0" cellspacing="0">
<tr>
<td>
<img src="upload/<? echo"$sj[photo]";?>.jpg" width="300px" height="200px" align="middle" class="center border" alt="sejarah">
</td>
</tr></table>
<p align="justify"><? echo"$sj[sejarah]";?></p>
</div>


