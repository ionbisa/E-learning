<script type="text/javascript" src="script/script_jdwlkelas.js"> </script>

<?php
session_start();
if(empty($_SESSION['user']) or empty($_SESSION['pass']) or $_SESSION['leveluser']!="admin"){
	header('location: ../login.php');
}

//Include library yang diperlukan
include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_form.php";

//Membuat judul
create_title("sort-by-attributes", "Manajemen tugas Per Kelas");

//Membuat header dan footer tabel
create_table(array("Mapel","Materi","Kelas","Aksi"));

//Membuat form edit data
open_form("modal_jdwlkelas", "return save_data()");
   $qkelas = mysqli_query($mysqli, "SELECT * FROM kelas");
   $list = array();
   while($rk = mysqli_fetch_array($qkelas)){
      $list[] = array($rk['id_kelas'], $rk['kelas']);
   }
   create_checkbox("Kelas", "kelas", $list);	
close_form();
?>
