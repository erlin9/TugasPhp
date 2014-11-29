<div id="kanan" align="justify">
<?php
include ('koneksi.php'); 
    $id= $_POST['id_siswa'];
	$sql="SELECT * FROM tb_to WHERE id_siswa like '%$id%' ";
	$hasil=mysql_query($sql);
	$rec=mysql_fetch_array($hasil);
?>

<p> Nomor Siswa : <?=$rec['id_siswa'];?> </p>
<p> Nama Siswa : <?=$rec['nama_siswa']; ?></p>
<p> Kelas : <?=$rec['kelas']; ?></p>
<p> Asal Sekolah : <?=$rec['asal_sekolah']; ?></p>
<p> Skor : <?=$rec['skor']; ?></p>
</div>
