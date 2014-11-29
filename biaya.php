<div id="kanan" align="justify">
<center><h3>Jadwal Dan Biaya Bimbingan</h3></center>
		<table align="center" class="table-style01">
		<tr align="left">
        <th width="113">Jam Bimbingan:</th>
        <?php 
include ('koneksi.php');
$jam=mysql_query("SELECT * FROM tb_jam order by id_jam");
while ($ja=mysql_fetch_array($jam)){
?>
          <td width="45" style="color:#004bab"><?=$ja[jam];?>&shy;&sbquo;</td><? } ?> 
               </tr>               

                    </table>

<p align="justify">&nbsp;&nbsp;&nbsp;&nbsp;<b>Galileone</b> menawarkan pilihan waktu bimbingan yang variatif dan dapat disesuaikan dengan jadwal kegiatan siswa di sekolah.<b> Senin - Sabtu</b> dengan beberapa pilihan waktu. </p>

<table width="584" border="0" cellpadding="2" cellspacing="0" align="center">
<tr>
<th align="center"><h4>Biaya Bimbingan</h4></th>
</tr>
<tr><td align="center">

<table bgcolor="#FFFF66" align="left" class="table-style01" >
    <tr bgcolor="#FFFFFF" align="center">
    <td width="80"><b>Tingkatan</b></td>
    <td width=""><b>SD1-5</b></td>
    
   </tr>
  
<?php 
$biaya = mysql_query("select * from tb_biaya where tingkat='SD1-5' ");
while ($b=mysql_fetch_array($biaya)){
?>
    <tr>
    <td width="75"><b><?=$b[id_program];?></b></td>
    <td align="left" width="75">Rp.<?=$b[biaya];?> </td>  
    <? } ?> </tr>
 </table>
<table bgcolor="#FFFF66" align="left" class="table-style01">
    <tr bgcolor="#FFFFFF" align="center">
    <td width=""><b>SD6</b></td>
    </tr>
<?php 
$biaya = mysql_query("select * from tb_biaya where tingkat='SD6' ");
while ($b=mysql_fetch_array($biaya)){
?>    <tr>
    <td align="left" width="75">Rp.<?=$b[biaya];?> </td>  
    <? } ?>
   </tr>
 </table>
<table bgcolor="#FFFF66" align="left" class="table-style01">
    <tr bgcolor="#FFFFFF" align="center">
    <td width=""><b>SMP7-8</b></td>
    </tr>
<?php 
$biaya = mysql_query("select * from tb_biaya where tingkat='SMP7-8' ");
while ($b=mysql_fetch_array($biaya)){
?>    <tr>
    <td align="left" width="75">Rp.<?=$b[biaya];?> </td>  
    <? } ?>
   </tr>
 </table>
<table bgcolor="#FFFF66" align="left" class="table-style01">
    <tr bgcolor="#FFFFFF" align="center">
    <td width=""><b>SMP9</b></td>
    </tr>
<?php 
$biaya = mysql_query("select * from tb_biaya where tingkat='SMP9' ");
while ($b=mysql_fetch_array($biaya)){
?>    <tr>
    <td align="left" width="75">Rp.<?=$b[biaya];?> </td>  
    <? } ?>
   </tr>
 </table>
 <table bgcolor="#FFFF66" align="left" class="table-style01">
    <tr bgcolor="#FFFFFF" align="center">
    <td width=""><b>SMA10-11</b></td>
    </tr>
<?php 
$biaya = mysql_query("select * from tb_biaya where tingkat='SMA10-11' ");
while ($b=mysql_fetch_array($biaya)){
?>    <tr>
    <td align="left" width="75">Rp.<?=$b[biaya];?> </td>  
    <? } ?>
   </tr>
 </table>
 <table bgcolor="#FFFF66" align="left" class="table-style01">
    <tr bgcolor="#FFFFFF" align="center">
    <td width=""><b>SMA12</b></td>
    </tr>
<?php 
$biaya = mysql_query("select * from tb_biaya where tingkat='SMA12' ");
while ($b=mysql_fetch_array($biaya)){
?>    <tr>
    <td align="left" width="75">Rp.<?=$b[biaya];?> </td>  
    <? } ?>
   </tr>
 </table>
</td>
</tr>
</table>
</div>


