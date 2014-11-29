<?php 
session_start();
include ('../koneksi.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
		<div id="utama">
		<div id="main">
<?php

//-----------------------------------menu utama
echo "<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=biaya1'><b>Admin Biaya</b></a> | Admin Biaya Ubah";
//-------------------------admin_galeri---------------------------------

echo"	<form method='post' action='admin_biaya_ubah_nya.php'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2' ><b>BIAYA BIMBEL GALILEONE</b></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>";
						
		include "../koneksi.php";
		
		$sql="SELECT * FROM tb_biaya WHERE id_biaya='".$_GET[id_ubah]."'";
		$hasil=mysql_query($sql);
		
		while($rec=mysql_fetch_array($hasil))	
		{
		
						echo "
						<input type='hidden' name='id' value='".$rec['id_biaya']."'></input>";
						
						echo " <table width='400' border='0' cellpadding='2' cellspacing='2' bgcolor='#FFFF66'>
									<tr>
										<td align='left' valign='top'>Program Bimbingan</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'>";?>
                                        <select class="" name="nama_program">
   										<option value="">- Pilih Program Bimbingan -</option>
   										<?php $probim=mysql_query("SELECT * FROM tb_program ORDER BY nama_program ASC");
										while($pr=mysql_fetch_array($probim)){?>
   <option value="<?=$pr[nama_program];?>" <?php if($pr[nama_program]==$rec[id_program]){?> selected="selected" <? } ?>><?=$pr[nama_program];?></option>
     <? } ?>
   </select>
										
										<?php echo"</td>
									</tr>
									<tr>
										<td align='left' valign='top'>Tingkat</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='tingkat' size='30' value='".$rec['tingkat']."' />                                    </td>
									</tr>
													
									<tr>
										<td align='left' valign='top'>Biaya</td>
										<td align='left' valign='top'>:</td>
										<td align='left' valign='top'><input type='text' name='biaya' size='30' value='".$rec['biaya']."' /></td>
									</tr>
									
									<tr>
										<td align='right' colspan='3'>&nbsp;</td>
									</tr>";
		}
							echo"	<tr>
										<td align='right' colspan='3'><input type='submit' value='Simpan'></td>
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
?>
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>