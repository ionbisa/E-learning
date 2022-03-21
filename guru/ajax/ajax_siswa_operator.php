<?php
session_start();
include "../../library/config.php";

//Menampilkan data pada tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM siswa ORDER BY nis");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $kelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'"));

      if($r['status'] == "login") $status = '<b class="text-primary">login</b>';
      elseif($r['status'] == "mengerjakan") $status = '<b class="text-danger">mengerjakan</b>';
      else $status = '<b class="text-muted">off</b>';
		
      $row = array();
      $row[] = $no;
      $row[] = $r['nis'];
      $row[] = $r['nama'];
      $row[] = $r['password'];
      $row[] = $kelas['kelas'];
      $row[] = $status;
      $row[] = '<a class="btn btn-danger" onclick="reset_login('.$r['no'].')"><i class="glyphicon glyphicon-off"></i> Reset Login</a>';
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}


//Reset login
elseif($_GET['action'] == "reset_login"){
   mysqli_query($mysqli, "UPDATE siswa set status='off' WHERE no='$_GET[nis]'");
}
?>