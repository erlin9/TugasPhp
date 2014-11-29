<?
	require_once ('libs/fpdf/fpdf.php');
	require_once ('koneksi.php');
	
	
	$sql="SELECT * FROM tb_pendaftaran WHERE id_siswa LIKE '".$_GET[id]."%'";
	$hasil=mysql_query($sql);
	$rec=mysql_fetch_array($hasil);
	
	$pdf=new FPDF();
	
	//buat halaman PDF
	$pdf->AddPage();
		
	$pdf->Image('gambar/simbol_putih.jpg',10,8,C);
	$pdf->Ln(80);
	
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(0,221,0);
	$pdf->Cell(0,6,"BUKTI PENDAFTARAN",0,1,'L',1);
	$pdf->Ln(2);
	
	$pdf->SetFont('Arial','',9);
	
	$pdf->MultiCell(200,5,'No Siswa     :'.$rec['id_siswa'],0,2);
	$pdf->MultiCell(200,5,'Nama Lengkap :'.$rec['nama_siswa'],0,2);
	$pdf->MultiCell(200,5,'Kelas        :'.$rec['kelas'],0,2);
	$pdf->MultiCell(200,5,'Asal Sekolah :'.$rec['asal_sekolah'],0,2);
	$pdf->MultiCell(200,5,'Alamat Rumah/Kos :'.$rec['alamat'],0,2);
	$pdf->Ln(5);
	
	//menampilkan hasil yang mau jadi PDF
	$pdf->Output();
?>