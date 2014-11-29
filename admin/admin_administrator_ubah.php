<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Galileone - The Official Site </title>
<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="../slider/engine1/style.css"/>
	<style type="text/css">a#vlb{display:none}</style>
	<script type="text/javascript" src="../slider/engine1/jquery.js"></script>
	<script type="text/javascript" src="../slider/engine1/wowslider.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
    

	<!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
		<div id="utama">
		<div id="main">
<?php

//-----------------------------------menu utama---------------------------
echo"<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=data_admin'><b>Admin Administrator</b></a> | Admin Administrator Ubah";
//-------------------------admin_sejarah---------------------------------
echo"	<form action='admin_administrator_ubah_nya.php' method='post'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>ADMINISTRATOR GALILEONE</td>
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
		$sql="SELECT * FROM tb_admin WHERE id_admin='".$id_ubah."'";
		$hasil=mysql_query($sql);
		
		while($rec=mysql_fetch_array($hasil))	
		{
					echo"<input type='hidden' name='id_ubah_nya' value='$id_ubah'></input>";			
					
					echo"<tr>
						<td width='100' valign='top' align='left'>ID Pegawai</td>
						<td valign='top'>:</td>
						<td width='300' valign='top' align='left'><input type='text' name='id_pegawai' size='15' value='".$rec['id_pegawai']."' /></td>
						</tr>
						<tr>
						<td width='100' valign='top' align='left'>Username</td>
						<td valign='top'>:</td>
						<td width='' valign='top' align='left'>
						<input type='text' name='username' class='required'/></td>
						</tr>
						<tr>
						<td width='100' valign='top' align='left'>Password</td>
						<td valign='top'>:</td>
						<td width='' valign='top' align='left'>
						<input type='password' name='password' class='required' size='25'/></td>
						</tr>	
						<tr>
						<td align='left' width='200'>Konfirmasi Password</td>
						<td valign='top'>:</td>
						<td align='left'><input type='password' name='konfirms_password' size='25'></td>
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