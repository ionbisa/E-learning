<?php
session_start();
include "../../library/config.php";

$lama = $_POST['lama'];
$baru = $_POST['baru'];
	
$cek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM guru WHERE id_guru='$_SESSION[iduser]'"));
if($cek['password'] != $lama){
   echo "Password lama salah!";
}else{
   mysqli_query($mysqli, "UPDATE guru SET password='$baru' WHERE id_guru='$_SESSION[iduser]'");
   echo "ok";
}
?>