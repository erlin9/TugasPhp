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

<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=biaya1'><b>Admin Biaya Bimbingan</b></a> | Admin Biaya Bimbingan Tambah

	<form name='biaya_tambah' action='admin_biaya_tambah_nya.php' method='get'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>BIAYA BIMBINGAN GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='400' border='0' cellpadding='2' cellspacing='2'  bgcolor='#FFFF66'>
								<tr>
									<td width='100' valign='top' align='left'>Nama Program</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'>
									 <select class='' name='nama_program'>
         							 <option value="">- Pilih Program Bimbingan -</option>";
          							<?php $probim=mysql_query("SELECT * FROM tb_program ORDER BY nama_program ASC");
		  							while($pr=mysql_fetch_array($probim)){?>
          							<option value="<?=$pr[nama_program];?>"><?=$pr[nama_program];?></option>
          							<? } ?>
   									 </select>
						</td>
						</tr>
								<tr>
									<td width='100' valign='top' align='left'>Tingkat</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='tingkat'/></td>
								</tr>
								<tr>
									<td width='100' valign='top' align='left'>Biaya</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='biaya'/></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align='right'><input type='submit' value='Simpan'></td>
								</tr>
							</table>
					
							<td width='5'>&nbsp;</td>
							</tr>
							<tr>
								<td colspan='3'>&nbsp;</td>
							</tr>
						</table>
						</form>
				
<div id="footer" align="center" ><br />
Galileone Official Site &copy; 2012 </div>
</div>
</div>
</div>
</body>
</html>