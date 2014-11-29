<?php 
session_start();
include ('../koneksi.php');
?>
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
<style type="text/css">
<!--
.style3 {font-size: 10px}
.style4 {font-size: 14px}
-->
    </style>    

	<!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div id="wrapper">
<div id="header" align="center"></div>
<div id="utama">
<div id="main">
<?php
//-----------------------------------menu utama---------------------------
echo "<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=data_admin'><b>Admin Administrator</b></a> | Admin Tambah Administrator";
//-------------------------admin_sejarah---------------------------------
echo"	<form name='administrator_tambah' action='admin_administrator_tambah_nya.php' method='get'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>ADMINISTRATOR GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='400' border='0' cellpadding='2' cellspacing='2'  bgcolor='#FFFF66'>
								<tr>
									<td width='100' valign='top' align='left'>ID Pegawai</td>
									<td valign='top'>:</td>
									<td width='' valign='top' align='left'>
									<input  type='text' name='id_pegawai' class='required'/></td>
								</tr>
								<tr>
									<td width='100' valign='top' align='left'>Username</td>
									<td valign='top'>:</td>
									<td width='' valign='top' align='left'>
									<input  type='text' name='username' class='required'/></td>
								</tr>
								<tr>
									<td width='100' valign='top' align='left'>Password</td>
									<td valign='top'>:</td>
									<td width='' valign='top' align='left'>
									<input type='password' name='password' class='required'/></td>
								</tr>
								
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align='right'><input type='submit' value='Simpan'></td>
								</tr>
							</table>";
					
					echo "	<td width='5'>&nbsp;</td>
							</tr>
							<tr>
								<td colspan='3'>&nbsp;</td>
							</tr>
						</table>
						</form>";
				
?>
<div id="footer" align="center" ><br />
Galileone Official Site © 2012 </div>
</div>
</div>
</div>
</body>
</html>