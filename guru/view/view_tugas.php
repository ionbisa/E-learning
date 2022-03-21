<link rel="stylesheet" type="text/css" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script type="text/javascript" src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="script/script_tugas.js"> </script>

<?php
session_start();
if(empty($_SESSION['user']) or empty($_SESSION['pass']) or $_SESSION['leveluser']!="admin"){
   header('location: ../login.php');
}

//include library yang diperlukan
include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_form.php";

//membuat judul dan tombol tambah
create_title("edit", "Manajemen tugas");
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

//membuat header dan footer tabel
create_table(array("Nama Mapel", "Materi", "Tanggal", "Waktu", "Jml. Soal", "Guru", "Aksi"));

//membuat form tambah dan edit data
open_form("modal_tugas", "return save_data()");
   create_textbox("Materi", "topik", "text", 4, "", "required");
   create_textbox("Nama Mapel", "mapel", "text", 4, "", "required");
   echo'<div class="form-group">
   <label for="tanggal" class="col-sm-2 control-label">Tanggal</label>
   <div class="col-sm-4">
      <input type="date" class="form-control" id="tanggal" name="tanggal">
   </div> </div>';
   echo'<div class="form-group">
		<label for="nis" class="col-sm-2 control-label">Waktu (Menit)</label>
		<div class="col-sm-2">
			<input type="number" class="form-control" id="waktu" name="waktu" min="1" required>
		</div> 
	 </div>';
	echo'<div class="form-group">
		<label for="nis" class="col-sm-2 control-label">Jumlah Soal</label>
		<div class="col-sm-2">
			<input type="number" class="form-control" id="jml_soal" name="jml_soal" min="1" required>
		</div> 
	 </div>';	
   $quser = mysqli_query($mysqli, "SELECT * FROM guru WHERE level='guru'");
   $list = array();
   while($ru = mysqli_fetch_array($quser)){
      $list[] = array($ru['no'], $ru['nama']);
   }
   create_combobox("Penguji", "pengampu", $list, 4, "", "required");	
close_form();
?>
