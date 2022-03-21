<?php
session_start();
include "../library/config.php";
include "../library/function_antiinjection.php";

$username = antiinjeksi($_POST['username']);
$password = antiinjeksi($_POST['password']);

$cekuser = mysqli_query($mysqli, "SELECT * FROM guru WHERE id_guru='$username' AND password='$password'");
$jmluser = mysqli_num_rows($cekuser);
$data = mysqli_fetch_array($cekuser);
if($jmluser > 0){
   $_SESSION['id']       = $data['no'];
   $_SESSION['user']     = $data['id_guru'];
   $_SESSION['nama']  = $data['nama'];
   $_SESSION['pass']     = $data['password'];
   $_SESSION['iduser']       = $data['id_guru'];
   $_SESSION['jk']       = $data['jk_guru'];
   $_SESSION['leveluser']    = $data['level'];
   $_SESSION['timeout'] = time()+1000;
   $_SESSION['login'] = 1;
   echo "ok";
}else{
   echo "<b>ID Guru</b> atau <b>password</b> tidak terdaftar!";
}
?>