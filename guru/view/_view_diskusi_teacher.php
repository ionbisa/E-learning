<script type="text/javascript" src="script/script_diskusi_teacher.js"> </script>

<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="guru"){
   header('location: login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";

create_title("edit", "Manajemen Diskusi");

create_table(array("Materi", "Nama Mapel", "Tanggal tugas", "Diskusi"));
?>