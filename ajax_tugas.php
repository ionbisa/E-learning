<?php
session_start();
include "library/config.php";

if(empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}

//Memproses data ajax ketika memilih salah satu jawaban
if($_GET['action']=="kirim_jawaban"){
   $rnilai = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_tugas='$_POST[tugas]' AND nis='$_SESSION[nis]'"));
	
   $jawaban = explode(",", $rnilai['jawaban']);
   $index = $_POST['index'];	
   $jawaban[$index] = $_POST['jawab'];
	
   $jawabanfix = implode(",", $jawaban);
   mysqli_query($mysqli, "UPDATE nilai SET jawaban='$jawabanfix', sisa_waktu='$_POST[sisa_waktu]' WHERE id_tugas='$_POST[tugas]' AND nis='$_SESSION[nis]'");
	
   echo "ok";
}

//Memproses data ajax ketika menyelesaikan tugas
elseif($_GET['action']=="selesai_tugas"){
   $rnilai = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_tugas='$_POST[tugas]' AND nis='$_SESSION[nis]'"));
	
   $arr_soal = explode(",", $rnilai['acak_soal']);
   $jawaban = explode(",", $rnilai['jawaban']);
   $jbenar = 0;
   for($i=0; $i<count($arr_soal); $i++){
      $rsoal = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM soal WHERE id_tugas='$_POST[tugas]' AND id_soal='$arr_soal[$i]'"));
      if($rsoal['kunci'] == $jawaban[$i]) $jbenar++;
   }
	
   $nilai = $jbenar/count($arr_soal)*100;
	
   mysqli_query($mysqli, "UPDATE nilai SET jml_benar='$jbenar', nilai='$nilai' WHERE id_tugas='$_POST[tugas]' AND nis='$_SESSION[nis]'");
   
   mysqli_query($mysqli, "UPDATE siswa SET status='login' WHERE nis='$_SESSION[nis]'");
   
   echo "ok";
}
?>