<?php
session_start();
include "library/config.php";
include "library/function_antiinjection.php";

$username = antiinjeksi($_POST['username']);
$password = antiinjeksi(($_POST['password']));
$akses = $_POST['akses'];

if($akses=="admin"){
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
	   echo "admin";
	}else{
	   echo "<b>NIS/NIP</b> atau <b>password</b> Salah!";
	}	
}else if($akses=="guru"){
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
	   $_SESSION['timeout'] = time()+1000;
	   $_SESSION['login'] = 1;
	   echo "guru";
	}else{
	   echo "<b>NIS/NIP</b> atau <b>password</b> Salah!";
	}
}else{
	$cekuser = mysqli_query($mysqli, "SELECT * FROM siswa WHERE nis='$username' AND password='$password'");
	$jmluser = mysqli_num_rows($cekuser);
	$data = mysqli_fetch_array($cekuser);
	if($jmluser > 0){
		 $_SESSION['username']     = $data['nis'];
		 $_SESSION['namalengkap']  = $data['nama'];
		 $_SESSION['password']     = $data['password'];
		 $_SESSION['nis']          = $data['nis'];
		 $_SESSION['kelas']        = $data['id_kelas'];
		 $_SESSION['siswa']        = "siswa";
		 echo "siswa";
	}else{
	   echo "<b>NIS</b> atau <b>password</b> Salah!";
	}
	
}
?>