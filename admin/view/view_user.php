<script type="text/javascript" src="script/script_user.js"> </script>

<?php
session_start();
if(empty($_SESSION['user_adm']) or empty($_SESSION['pass_adm'])){
   header('location: ../login.php');
}

//Include library yang dibutuhkan
include "../../library/function_view.php";
include "../../library/function_form.php";

//Membuat judul dan tombol tambah user
create_title("user", "Manajemen Guru");
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

//Membuat header dan footer tabel
create_table(array("NIP Guru","Nama Guru","Tempat Lahir","Tgl Lahir","Telepon","Jns Kelamin","Keterangan","Aksi"));

//Membuat form tambah dan edit user
open_form("modal_user", "return save_data()");
echo'<div class="form-group">
		<label for="id" class="col-sm-2 control-label">NIP Guru</label>
		<div class="col-sm-4">
			<input type="number" class="form-control" id="idguru" name="idguru" maxlength="6" required>
		</div> 
	 </div>';
   create_textbox("Nama", "nama", "text", 4, "", "required");
   create_textbox("Tempat Lahir", "tl", "text", 4, "", "required");
   echo'<div class="form-group">
   <label for="tgl" class="col-sm-2 control-label">Tgl. Lahir</label>
   <div class="col-sm-4">
      <input type="date" class="form-control" id="tgl" name="tgl">
   </div> </div>';
   echo'<div class="form-group">
		<label for="telp" class="col-sm-2 control-label">Telepon</label>
		<div class="col-sm-4">
			<input type="number" class="form-control" id="telp" name="telp" minlength="10" min="0" required>
		</div> 
	 </div>';   
   $list = array();
   $list[] = array("Laki-Laki", "Laki-Laki");
   $list[] = array("Perempuan", "Perempuan");
   create_combobox("Jenis Kelamin", "jk", $list, 4, "", "required");
   create_textbox("Keterangan", "keterangan", "text", 4, "", "required");
   close_form();
?>
