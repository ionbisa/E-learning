<script type="text/javascript" src="script/script_profil.js"> </script>

<?php
session_start();
if(empty($_SESSION['user_adm']) or empty($_SESSION['pass_adm'])){
	header('location: ../login.php');
}

include "../../library/function_view.php";
include "../../library/function_form.php";

create_title("user", "Profil User");

echo '<hr/><form id="form-profil" class="form-horizontal" onsubmit="return edit_data()">';
	
create_textbox("Nama Lengkap", "nama_lengkap", "text", 4, "", 'value="'.$_SESSION['nama_adm'].'" readonly');
create_textbox("Username", "username", "text", 4, "", 'value="'.$_SESSION['user_adm'].'" readonly');
create_textbox("Password Lama", "lama", "password", 4, "", "required");
create_textbox("Password Baru", "baru", "password", 4, "", "required");
create_textbox("Ulang Password", "ulang", "password", 4, "", "required");

echo '<div class="form-group">
<div class="col-md-2 col-md-offset-2"><button class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Ubah Password </button></div>
</div></form>';
?>
