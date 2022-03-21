<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";

if($_GET['action'] == "table_data"){
	$query = mysqli_query($mysqli, "SELECT * FROM diskusi, siswa WHERE diskusi.nis=siswa.nis AND diskusi.id_tugas='$_GET[tugas]'");
	while($r = mysqli_fetch_array($query)){
      $nis = $r['nis'];
	  $siswa = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM SISWA WHERE NIS='$nis'"));

      $row = array();
      $row[] = $r['isi'];
      $data[] = $row;
   }	
   $output = array("data" => $data);
   echo json_encode($output);
}

//Menampilkan data ke form edit
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_diskusi='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

//Menambahkan data soal ke database
elseif($_GET['action'] == "insert"){
   $pesan = addslashes($_POST['pesan']);
   mysqli_query($mysqli, "INSERT INTO diskusi SET 
      id_tugas = '$_GET[tugas]',
      id_kelas = '$_GET[kelas]',
      isi = '$pesan',
	  nama_user = '$_SESSION[nama]',
	  id_user = '$_SESSION[iduser]'");
   echo "ok";
}

//Mengedit data soal pada database tambahan id_tugas = '$_GET[tugas]',
elseif($_GET['action'] == "update"){
   $pesan = addslashes($_POST['pesan']);
   mysqli_query($mysqli, "UPDATE diskusi SET isi = '$pesan' WHERE id_diskusi='$_POST[id]'");
   echo "ok";
}

//Menghapus data
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM diskusi WHERE id_diskusi='$_GET[id]'");	
}
?>