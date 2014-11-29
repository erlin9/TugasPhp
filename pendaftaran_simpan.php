<?php 

include('koneksi.php');	
if($_POST[add_photo]!=""){
	if($_FILES['photo']['type']!=""){   
	$namafot=date("dmYHis");
	copy($_FILES['photo']['tmp_name'],"upload/".$namafot.".jpg");
					 }else{
		$namafot="kosong";						 
					 }
	
//SQL memasukkan data di table form	
mysql_query("INSERT INTO tb_pendaftaran(
								id_siswa,
							   nama_siswa,
                               jk,
							   tempat_lahir,
							   tgl_lahir,
							   alamat,
							   kode_pos,
							   no_tlp,
							   email,
							  asal_sekolah,
							   kelas,
							   	id_program,
								ortu,
								id_alamat,
							   photo)
			
                               VALUES(
							   '$_POST[id_siswa]',
							   '$_POST[nama]',
							   '$_POST[jeniskelamin]',
							   '$_POST[tempat_lahir]',
							   '$_POST[tgl_lahir]',
							   '$_POST[alamat]',
							   '$_POST[kodepos]',
							   '$_POST[nohp]',
							   '$_POST[email]',
							   '$_POST[asal_sekolah]',
							    '$_POST[kelas]',
							   '$_POST[nama_program]',
							   '$_POST[ortu]',
							    '$_POST[tempat_bimbingan]',
							    '$namafot' )"); 
?>

    <script>window.location.href='pendaftaran_sukses.php?id=<?=$_POST[id_siswa];?>'</script>;
    
<? } ?>