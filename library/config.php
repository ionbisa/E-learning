<?php
$host	= "localhost";
$user	= "root";
$pass	= "";
$db		= "database";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpanya dalam variabel $mysqli	
$mysqli = new mysqli($host, $user, $pass, $db);
$identitas = mysqli_fetch_array(mysqli_query($mysqli, 'SELECT id,nama,alamat FROM identitas WHERE id=1'));
$myid['nama'] = $identitas['nama'];
$myid['alamat'] = $identitas['alamat'];

//Membuat variabel yang menyimpan url website dan folder website
$url_website = "http://localhost/elearning";
$folder_website = "/elearning";  //setting disini akan mempengaruhi path gambar atau video

//Menentukan timezone 
date_default_timezone_set('Asia/Jakarta'); 
?>