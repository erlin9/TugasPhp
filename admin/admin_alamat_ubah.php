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

//-----------------------------------menu utama---------------------------
echo"<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=alamat1'><b>Admin Alamat</b></a> | Admin Alamat Ubah";
//-------------------------admin_sejarah---------------------------------
echo"	<form name='alamat_ubah' action='admin_alamat_ubah_nya.php' method='get'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>ALAMAT GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='400' border='0' cellpadding='2' cellspacing='2'  bgcolor='#FFFF66'>";
					
//--------------------------------sql-----------------------------------
		include "../koneksi.php";
		extract($_GET);
		$sql="SELECT * FROM tb_alamat WHERE id_alamat='".$id_ubah_alamat."'";
		$hasil=mysql_query($sql);
		
		while($rec=mysql_fetch_array($hasil))	
		{
					echo"<input type='hidden' name='id_ubah_alamat_nya' value='$id_ubah_alamat'></input>";			
					
					echo"<tr>
						<td width='100' valign='top' align='left'>Alamat</td>
						<td valign='top'>:</td>
						<td width='300' valign='top' align='left'><textarea rows='3' cols='25' name='alamat'>".$rec['alamat']."</textarea></td>
						</tr>
						<tr>
						<td width='100' valign='top' align='left'>No Telpon</td>
						<td valign='top'>:</td>
						<td width='' valign='top' align='left'>
						<input type='text' name='tlp' class='required'  value='".$rec['tlp']."' /></td>
						</tr>
						<tr>
						<td width='100' valign='top' align='left'>No HP</td>
						<td valign='top'>:</td>
						<td width='' valign='top' align='left'>
						<input type='text' name='hp' class='required'  value='".$rec['hp']."' /></td>
						</tr>		
						";
		}
					
					echo"		<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align='right'><input type='submit' value='Simpan'></td>
								</tr>";
					
					echo"</table>";
					
					echo"	<td width='5'>&nbsp;</td>
						</tr>";
						
						
					echo"	<tr>
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