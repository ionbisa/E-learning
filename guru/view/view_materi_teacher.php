<link rel="stylesheet" type="text/css" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script type="text/javascript" src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="script/script_materi.js"> </script>

<?php
session_start();
if(empty($_SESSION['user']) or empty($_SESSION['pass'])){
   header('location: login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_form.php";

create_button("primary", "import", "Upload", "btn-import", "form_import()");
create_title("list-alt", "Manajemen Materi");
create_table(array("Judul Materi","Mapel","Tanggal ","Download Materi"));

//Membuat form import soal
open_form("modal_import", "return import_data()");
   create_textbox("Pilih File .pdf", "file", "file", 6, "", "required");
   $tugas = mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_guru='$_SESSION[id]'");
   $list = array();
   while($ru = mysqli_fetch_array($tugas)){
      $list[] = array($ru['id_tugas'], $ru['topik'].' - '.$ru['nama_mapel']);
   }
   create_combobox("Mata Pelajaran", "tugas", $list, 6, "", "required");
close_form("import", "Upload");

?>