<?php
session_start();
include "../../library/config.php";

$lama = $_POST['lama'];
$baru = $_POST['baru'];
	
$cek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM admin WHERE id_adm='$_SESSION[id_adm]'"));
if($cek['pass_adm'] != $lama){
   echo "Password lama salah!";
}else{
   mysqli_query($mysqli, "UPDATE admin SET pass_adm='$baru' WHERE id_adm='$_SESSION[id_adm]'");
   echo "ok";
}
?>