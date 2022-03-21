<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";
$guru = $_SESSION['id'];
//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $tgl = date('Y-m-d');
   $query = mysqli_query($mysqli, "SELECT * FROM tugas WHERE tanggal='$tgl' AND id_guru='$guru'");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
		
      $qkelas = mysqli_query($mysqli, "SELECT * FROM kelas t1, kelas_tugas t2 WHERE t1.id_kelas=t2.id_kelas AND t2.id_tugas='$r[id_tugas]'");
      $label = "";
      while($rk = mysqli_fetch_array($qkelas)){
         if($rk['aktif']=='Y') $class = 'btn-danger';
         else $class = 'btn-primary';
         $label .= '<a class="btn btn-sm '.$class.'" onclick="edit_data('.$rk['id_kelas'].','.$rk['id_tugas'].')">'.$rk['kelas'].'</a> ';
      }
      
      $row = array();
      $row[] = $no;
      $row[] = $r['topik'];
      $row[] = $r['nama_mapel'];
      $row[] = $label;
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

//Mengaktifkan atau menonaktifkan kelas tugas
elseif($_GET['action'] == "update"){
   $cek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas_tugas WHERE id_tugas='$_GET[tugas]' AND id_kelas='$_GET[kelas]'"));
   $aktif = ($cek['aktif']=='Y') ? 'N' : 'Y';
   mysqli_query($mysqli, "UPDATE kelas_tugas set aktif='$aktif' WHERE id_tugas='$_GET[tugas]' AND id_kelas='$_GET[kelas]'");
}
?>
