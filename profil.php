<script type="text/javascript" src=""> </script>

<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
	header('location: login.php');
}

include "library/config.php";
include "library/function_view.php";
include "library/function_form.php";

create_title("user", "Profil Siswa");

echo '<hr/><form id="form-profil" class="form-horizontal" onsubmit="return edit_data()">';
$cek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_SESSION[kelas]'"));
	
create_textbox("NIS", "nis", "text", 4, "", 'value="'.$_SESSION['nis'].'" readonly');
create_textbox("Nama", "nama_lengkap", "text", 4, "", 'value="'.$_SESSION['namalengkap'].'" readonly');
create_textbox("Kelas", "kelas", "text", 4, "", 'value="'.$cek['kelas'].'" readonly');

echo '<div class="form-group">
</div></form>';
?>
