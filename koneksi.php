<?PHP
ini_set('display_errors','On');
ini_set('register_globals','Off');

$self = $_SERVER['PHP_SELF'];

if (ereg("koneksi.php", $self))
{
header("location: index.php");
die;
}

//Konfigurasi nama host, nama user dan password
$Host = 'localhost';
$User = 'root';
$Pass = '';
$Namadb = 'db_galileo';




/*Membangun koneksi. Bagian perintah or die akan 
dijalankan jika koneksi gagal dilakukan*/
$konek = mysql_connect($Host, $User, $Pass) or die ("Koneksi gagal!!!" );

//memilih database
$db=mysql_select_db($Namadb);



?>