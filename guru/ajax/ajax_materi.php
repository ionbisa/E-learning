<?php
session_start();
include "../../library/config.php";
include "../../library/function_date.php";
include "../../library/function_view.php";
$user = $_SESSION['id'];
//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_guru='$user' ORDER BY id_tugas DESC");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $row = array();
      $row[] = $no;
      $row[] = $r['topik'];
      $row[] = $r['nama_mapel'];
      $row[] = tgl_indonesia($r['tanggal']);
      $row[] = $r['materi'];
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

//Import data dari format Excel
elseif($_GET['action'] == "import"){
	$name = strtolower($_FILES['file']['name']);
	$filename1 = explode(" ",$name);
	$filename = implode("",$filename1);
	
	$extensi  = substr($filename,-4);
	$extensi2  = substr($filename,-5);
	if($extensi != ".pdf"){
		echo "File yang di-upload tidak berformat .pdf!'";
	}else{
		$path = "../upload";
		if(move_uploaded_file($_FILES['file']['tmp_name'], "$path/$filename")){
			mysqli_query($mysqli, "UPDATE tugas SET materi='$filename' WHERE id_tugas='$_POST[tugas]'");
		}else{
			
		}
		echo "ok";
	}
}

//Menampilkan data ke form
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

?>
