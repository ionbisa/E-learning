<?php
session_start();
include "../../library/config.php";
include "../../library/function_date.php";

$query = mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_user='$_SESSION[iduser]' ORDER BY tanggal");
$data = array();
$no = 1;
while($r = mysqli_fetch_array($query)){

//Membuat tombol edit soal		
   $qsoal = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_tugas='$r[id_tugas]'");
   $btn_soal = '<a class="btn btn-primary btn-sm" onclick="show_diskusi('.$r['id_tugas'].')"><i class="glyphicon glyphicon-edit"></i> Edit &nbsp;&nbsp;<span class="label label-warning">'.mysqli_num_rows($qsoal).'</span></a>';
		
   $row = array();
   $row[] = $no;
   $row[] = $r['judul'];
   $row[] = $r['nama_mapel'];
   $row[] = tgl_indonesia($r['tanggal']);
   $row[] = $btn_soal;
   $data[] = $row;
   $no++;
}
	
$output = array("data" => $data);
echo json_encode($output);
?>