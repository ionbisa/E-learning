<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";

if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM kelas ORDER BY id_kelas DESC");
   $data = array();
      $no = 1;
      while($r = mysqli_fetch_array($query)){
         $row = array();
         $row[] = $no;
         $row[] = $r['kelas'];
         $row[] = create_action($r['id_kelas']);
         $data[] = $row;
         $no++;
      }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

elseif($_GET['action'] == "insert"){
   $password = md5($_POST['password']);
   
   mysqli_query($mysqli, "INSERT INTO kelas SET kelas = '$_POST[kelas]' ");	
}

elseif($_GET['action'] == "update"){
   $password = md5($_POST['password']);
   mysqli_query($mysqli, "UPDATE kelas SET kelas= '$_POST[kelas]' WHERE id_kelas='$_POST[id]'");
}

elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM kelas WHERE id_kelas='$_GET[id]'");	
}
?>
