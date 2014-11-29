<?php 
session_start();
include ('../koneksi.php');
?>
<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
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
echo "<a href='admin_index.php?show=home1'><b>Menu Utama</b></a> | <a href='admin_index.php?show=sejarah1'><b>Admin Sejarah</b></a> | Admin Sejarah Ubah";
//-------------------------admin_sejarah---------------------------------
echo"	<form action='admin_sejarah_ubah_nya.php' method='post' enctype='multipart/form-data'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0' >
					<tr>
						<td align='center' bgcolor='#004bab' height='30' colspan='3' class='k2'>SEJARAH GALILEONE</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td width='5'>&nbsp;</td>
						<td align='center'>
							<table width='' border='0' cellpadding='2' cellspacing='2'  bgcolor='#FFFF66'>";
					
//--------------------------------sql-----------------------------------
		include ('../koneksi.php');
		$sql="SELECT * FROM tb_sejarah WHERE id_sejarah='".$_GET[id_ubah]."'";
		$hasil=mysql_query($sql);
		
		while($rec=mysql_fetch_array($hasil))	
		{
					echo "<input type='hidden' name='id' value='".$rec['id_sejarah']."'></input>";			
					
					echo "		<tr>
									<td width='100' valign='top' align='left'>Sejarah&nbsp</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><textarea rows='10' cols='35' name='sejarah'>".$rec['sejarah']."</textarea></td>
								</tr>
								
								<tr>
									<td width='100' valign='top' align='left'>Photo&nbsp</td>
									<td valign='top'>:</td>
							<td width='300' valign='top' align='left'>
							<input type='hidden' name='hiddenphoto' value='".$rec['photo']."'>
							<img src='../upload/".$rec['photo'].".jpg' width='80px' height='80px' ><br />
							<p><b>".$rec['photo']."</b>.jpg</p>
</td>
								</tr>
								
								<tr>
									<td width='100' valign='top' align='left'>Ubah Photo&nbsp</td>
									<td valign='top'>:</td>
									<td width='300' valign='top' align='left'><input type='file' name='photo' size='30'/></td>
								</tr>
								
								";
		}
					
					echo "		<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align='right'><input type='submit' value='Simpan' name='edit_foto' ></td>
								</tr>";
					
					echo "</table>";
					
					echo "	<td width='5'>&nbsp;</td>
						</tr>";
						
					echo "	
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
</body>
</html>