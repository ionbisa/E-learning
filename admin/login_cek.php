<?php
session_start();
include "../library/config.php";
include "../library/function_antiinjection.php";

$username = antiinjeksi($_POST['username']);
$password = antiinjeksi($_POST['password']);

$cekuser = mysqli_query($mysqli, "SELECT * FROM admin WHERE user_adm='$username' AND pass_adm='$password'");
$jmluser = mysqli_num_rows($cekuser);
$data = mysqli_fetch_array($cekuser);
if($jmluser > 0){
   $_SESSION['id_adm']		= $data['id_adm'];
   $_SESSION['user_adm']	= $data['user_adm'];
   $_SESSION['nama_adm']	= $data['nama_adm'];
   $_SESSION['pass_adm']	= $data['pass_adm'];
   $_SESSION['jk_adm']		= $data['jk_adm'];
   $_SESSION['timeout'] 	= time()+1000;
   $_SESSION['login'] 		= 1;
   echo "ok";
}else{
   echo "<b>Username</b> atau <b>password</b> Salah!";
}
?>