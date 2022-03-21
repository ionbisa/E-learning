<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_lib.php";

//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM siswa ORDER BY id_kelas");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $kelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'"));
      $row = array();
      $row[] = $no;
      $row[] = $r['nis'];
      $row[] = $r['nama'];
      $row[] = $r['tmpt_lahir'];
      $row[] = IndonesiaTgl($r['tgl_lahir']);
      $row[] = $r['jk'];
      $row[] = $r['password'];
      $row[] = $kelas['kelas'];
      $row[] = create_action($r['no']);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}


//Menampilkan data ke form edit
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM siswa WHERE no='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

//Menambah data ke database
elseif($_GET['action'] == "insert"){
   $tgl			= IndonesiaTgl($_POST['tgl']);
   $passArray	= explode("-",$tgl);
   $pass		= implode("",$passArray);
   $jml = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM siswa WHERE nis='$_POST[nis]'"));
   if($jml > 0){
      echo "NIS Siswa sudah digunakan!";
   }else{
      mysqli_query($mysqli, "INSERT INTO siswa SET
         nis = '$_POST[nis]',
         nama = '$_POST[nama]',
         tmpt_lahir = '$_POST[tl]',
         tgl_lahir = '$_POST[tgl]',
         jk = '$_POST[jk]',
         password = '$pass',
         id_kelas= '$_POST[kelas]',	
         status= 'off'");	
      echo "ok";
   }
}

//Mengedit data
elseif($_GET['action'] == "update"){
   mysqli_query($mysqli, "UPDATE siswa SET
      nama = '$_POST[nama]',
      tmpt_lahir = '$_POST[tl]',
      tgl_lahir = '$_POST[tgl]',
      jk = '$_POST[jk]',
      id_kelas = '$_POST[kelas]'
      WHERE nis='$_POST[nis]'");
   echo "ok";
}

//Menghapus data
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM siswa WHERE no='$_GET[id]'");	
}

//reset password
elseif($_GET['action'] == "reset"){
   $data 		= mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM siswa WHERE no='$_GET[id]'"));
   if($data>0){
   $tgl			= IndonesiaTgl($data['tgl_lahir']);
   $passArray	= explode("-",$tgl);
   $pass		= implode("",$passArray);
   mysqli_query($mysqli, "UPDATE siswa SET password = '$pass' WHERE no='$_GET[id]'");
   }
}
//Import data dari file Excel
elseif($_GET['action'] == "import"){
   include "../../assets/excel_reader/excel_reader.php";
   $filename = strtolower($_FILES['file']['name']);
   $extensi  = substr($filename,-4);
		
   if($extensi != ".xls"){
      echo "File yang di-upload tidak berformat .xls!'";
   }else{
      $path = "../upload";			
      move_uploaded_file($_FILES['file']['tmp_name'], "$path/$filename");
			
      $file = "../upload/$filename";
			
      $data = new Spreadsheet_Excel_Reader();
      $data->read($file);
      $jdata = $data->rowcount($sheet_index=0);
			
      for($i=2; $i<=$jdata; $i++){		
         $nis = addslashes(str_replace(" ", "", $data->val($i,2)));
         $nama	= addslashes($data->val($i,3));
				
         $cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM siswa WHERE nis='$nis'"));
         if($cek > 0){
            mysqli_query($mysqli, "UPDATE siswa SET nama='$nama', id_kelas='$_POST[kelas_import]' WHERE  nis='$nis'");
         }else{
            $pass = (substr(($nis),4,5));
            mysqli_query($mysqli, "INSERT INTO siswa SET nis='$nis', nama='$nama', id_kelas='$_POST[kelas_import]', password='$pass', status='off'");
         }
      }	
      
      unlink($file);
      echo "ok";
   }
}
?>