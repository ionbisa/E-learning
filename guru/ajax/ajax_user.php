<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_lib.php";
include "../../library/function_date.php";


if($_GET['action'] == "table_data"){
	$query = mysqli_query($mysqli, "SELECT * FROM guru WHERE level!='admin' ORDER BY id_guru DESC");
	$data = array();
	$no = 1;
	while($r = mysqli_fetch_array($query)){
	   $row = array();
	   $row[] = $no;
	   $row[] = $r['id_guru'];
	   $row[] = $r['nama'];
	   $row[] = $r['tmptlahir'];
	   $row[] = tgl_indonesia($r['tgllahir']);
	   $row[] = $r['telp'];
	   $row[] = $r['jk_guru'];
	   $row[] = $r['keterangan'];
	   $row[] = create_actiontambah($r['no']);
	   $data[] = $row;
	   $no++;
	}
		
	$output = array("data" => $data);
	echo json_encode($output);
}

elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM guru WHERE no='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

elseif($_GET['action'] == "insert"){
   $tgl			= IndonesiaTgl($_POST['tgl']);
   $passArray	= explode("-",$tgl);
   $pass		= implode("",$passArray);
   $jml = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM guru WHERE id_guru='$_POST[idguru]'"));
   if($jml > 0){
      echo "ID Guru sudah digunakan!";
   }else{
	mysqli_query($mysqli, "INSERT INTO guru SET
      id_guru = '$_POST[idguru]',
      nama = '$_POST[nama]',
      tmptlahir = '$_POST[tl]',
      tgllahir = '$_POST[tgl]',
      telp = '$_POST[telp]',
      jk_guru = '$_POST[jk]',
      keterangan = '$_POST[keterangan]',
      password = '$pass',
      level= 'guru'");	
      echo "ok";
   }
}

elseif($_GET['action'] == "update"){
   mysqli_query($mysqli, "UPDATE guru SET
      nama = '$_POST[nama]',
      tmptlahir = '$_POST[tl]',
      tgllahir = '$_POST[tgl]',
      telp = '$_POST[telp]',
      jk_guru = '$_POST[jk]',
      keterangan = '$_POST[keterangan]'
      WHERE id_guru='$_POST[idguru]'");
    echo "ok";
   
}

//reset password
elseif($_GET['action'] == "reset"){
   $data 		= mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM guru WHERE no='$_GET[id]'"));
   if($data>0){
	   $tgl			= IndonesiaTgl($data['tgllahir']);
	   $passArray	= explode("-",$tgl);
	   $pass		= implode("",$passArray);
	   mysqli_query($mysqli, "UPDATE guru SET password = '$pass' WHERE no='$_GET[id]'");
   }
}

elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM guru WHERE no='$_GET[id]'");	
}

?>