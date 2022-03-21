<script type="text/javascript" src="script/script_siswa_operator.js"> </script>

<?php
session_start();
if(empty($_SESSION['user_adm']) or empty($_SESSION['pass_adm'])){
	header('location: ../login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_form.php";

create_title("list-alt", "Manajemen Siswa");
create_button("success", "refresh", "Refresh", "btn-refresh", "refresh_data()");

create_table(array("NIS", "Nama Siswa", "Password", "Kelas", "Status", "Aksi"));
?>