<?php
ini_set("display_errors",false);

//mengecek variable session
$self = $_SERVER['PHP_SELF'];
if(ereg("autentikasi.php",$self))
{
header("location:index.php");
die;

}

session_start();
if(!session_is_registered("status")) {
header("location:admin_error.php");
}



?>