<?php
session_start();
include "../../library/config.php";

if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM siswa WHERE id_kelas='$_GET[kelas]'");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $n = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE nis='$r[nis]' AND id_tugas='$_GET[tugas]'"));		
      $row = array();
      $row[] = $no;
      $row[] = $r['nis'];
      $row[] = $r['nama'];
      $row[] = $n['jml_benar'];		
      $row[] = $n['nilai'];
      $data[] = $row;
      $no++;
   }
   $output = array("data" => $data);
   echo json_encode($output);
}
?>
