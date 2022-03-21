<?php
// Membuat variabel, ubah sesuai dengan nama host dan database pada hosting 
$host	= "localhost";
$user	= "tunasdau_usertes";
$pass	= "coroladx87";
$db	= "tunasdau_etest";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpanya dalam variabel $mysqli	
$mysqli = new mysqli($host, $user, $pass, $db);
$identitas = mysqli_fetch_array(mysqli_query($mysqli, 'SELECT id,nama,alamat FROM identitas WHERE id=1'));
$myid['nama'] = $identitas['nama'];
$myid['alamat'] = $identitas['alamat'];

//Membuat variabel yang menyimpan url website dan folder website
//$url_website = "http://localhost/etest";
$url_website = "http://etest.tunasdaud.org";
//$url_website = "http://".$_SERVER['HTTP_HOST'] . '/etest';
//$folder_website = "/etest";
$folder_website = "/etest";

//Menentukan timezone 
date_default_timezone_set('Asia/Jakarta'); 
?>
