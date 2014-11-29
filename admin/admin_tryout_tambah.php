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

<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=tryout'><b>Admin Hasil Tryout</b></a> | Admin Tryout Tambah

	<form name='tryout_tambah' action='admin_tryout_tambah_nya.php' method='post'>
    <input type='hidden' name='id_to' value=''/>
		<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>HASIL TRY OUT GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='400' border='0' cellpadding='2' cellspacing='2'  bgcolor='#FFFF66'>
								<tr>
									<td width='100' valign='top' align='left'>No Siswa</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='id_siswa'/></td>
						       </tr>
								<tr>
									<td width='100' valign='top' align='left'>Nama Siswa</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='nama_siswa'/></td>
								</tr>
                                <tr>
									<td width='100' valign='top' align='left'>Kelas</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='kelas'/></td>
								</tr>
                                <tr>
									<td width='100' valign='top' align='left'>Asal Sekolah</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='asal_sekolah'/></td>
								</tr>
								<tr>
									<td width='100' valign='top' align='left'>Skor</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='text' name='skor'/></td>
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