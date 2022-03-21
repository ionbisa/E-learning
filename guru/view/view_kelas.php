<script type="text/javascript" src="script/script_kelas.js"> </script>

<?php
session_start();
if(empty($_SESSION['user']) or empty($_SESSION['pass']) or $_SESSION['leveluser']!="admin"){
   header('location: ../login.php');
}

include "../../library/function_view.php";
include "../../library/function_form.php";

create_title("signal", "Manajemen Kelas");
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

create_table(array("Nama Kelas", "Aksi"));

open_form("modal_kelas", "return save_data()");
   create_textbox("Nama Kelas", "kelas", "text", 4, "", "required");
close_form();
?>
