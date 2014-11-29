<div id="kanan" align="justify">
<?php 
$program = mysql_query("select * from tb_program WHERE id_program = '3'");
$p=mysql_fetch_array($program);
?><br />

<table align="center" width="400px" cellpadding="0" cellspacing="0">
<tr>
<td>
<h3>Ketentuan Program Bimbingan&nbsp;<? echo"$p[nama_program]";?></h3>
</td>
</tr></table>
<p align="justify"><? echo"$p[deskripsi]";?></p>
</div>


