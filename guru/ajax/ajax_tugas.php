<?php
session_start();
include "../../library/config.php";
include "../../library/function_date.php";
include "../../library/function_view.php";

//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM tugas ORDER BY id_tugas DESC");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM guru WHERE no='$r[id_guru]'"));
      $row = array();
      $row[] = $no;
      $row[] = $r['nama_mapel'];
      $row[] = $r['topik'];
      $row[] = tgl_indonesia($r['tanggal']);
      $row[] = $r['waktu'].' menit';
      $row[] = $r['jml_soal'];
      $row[] = $user['nama'];
      $row[] = create_action($r['id_tugas']);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

//Menampilkan data ke form
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

//Menambah data
elseif($_GET['action'] == "insert"){
   mysqli_query($mysqli, "INSERT INTO tugas SET
      topik = '$_POST[topik]',
      nama_mapel = '$_POST[mapel]',
      tanggal = '$_POST[tanggal]',
      waktu = '$_POST[waktu]',
      jml_soal = '$_POST[jml_soal]',
      id_guru = '$_POST[pengampu]'");	
}

//Mengedit data
elseif($_GET['action'] == "update"){
   mysqli_query($mysqli, "UPDATE tugas SET
      topik = '$_POST[topik]',
      nama_mapel = '$_POST[mapel]',
      tanggal = '$_POST[tanggal]',
      waktu = '$_POST[waktu]',
      jml_soal = '$_POST[jml_soal]',
      id_guru = '$_POST[pengampu]'
      WHERE id_tugas='$_POST[id]'");	
}

//Menghapus data
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM tugas WHERE id_tugas='$_GET[id]'");	
}
?>
