<script type="text/javascript" src="js/script_diskusi.js"> </script>

<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password'])){
   header('location: login.php');
}

//Memanggil library yang diperlukan
include "../library/config.php";
include "../library/function_view.php";
include "../library/function_date.php";
include "../library/function_form.php";

//Membuat judul, tombol Tambah dan tombol Import
create_title("list", "Manajemen Diskusi");
//Menampilkan detail tugas
$ru = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas='$_GET[tugas]'"));
$kls = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'"));
echo 
'<hr/>
<div class="alert alert-info">
<table width="100% no-ajax">
   <tr>
      <td>Materi</td><td>:<b> '.$ru['topik'].'</b></td>
      <td width="15%"></td>
      <td>Tanggal</td><td>:<b> ' .tgl_indonesia($ru['tanggal']).' </b></td>
   </tr>
   <tr>
      <td>Nama Mapel</td><td>:<b> '.$ru['nama_mapel'].'</b></td>
      <td width="15%"></td>
   </tr>
   <tr>
      <td>Kelas</td><td>:<b> '.$kls['kelas'].'</b></td>
      <td width="15%"></td>
      <td></td>
   </tr>
</table>
<input type="hidden" id="id_tugas" value="'.$_GET['tugas'].'">
<input type="hidden" id="id_kelas" value="'.$_GET['kelas'].'">
</div>
<hr/>';

$row = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_tugas='$_GET[tugas]' AND id_kelas='$_GET[kelas]'"));
if($row>0){
$query = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_tugas='$_GET[tugas]' AND id_kelas='$_GET[kelas]'");
while($r = mysqli_fetch_array($query)){
echo
'<div class="alert alert-warning">
<table width="100%">
   <tr>
      <td><b>'.$r['id_user'].' - '.$r['nama_user'].'</b></td>
   </tr>
   <tr>
	  <td><hr/></td>
   </tr>
   <tr>
      <td>'.$r['isi'].'</td>
   </tr>
</table>
<input type="hidden" id="id_tugas" value="'.$_GET['tugas'].'">';
$id=$r['id_diskusi'];
$user=$r['id_user'];
$user1=$_SESSION['nis'];
if($user==$user1){
	echo '<hr/><a onclick="form_edit('.$id.')">Edit</a> &nbsp; <a onclick="delete_data('.$id.')">Hapus</a>';
}
echo'</div>';
}
}else{
echo'
<div class="alert alert-warning">
<center>Belum ada Diskusi.</center>
</div>';	
}
echo '<hr/>';
create_button("success", "plus-sign", "Tambah Diskusi", "btn-add", "form_add()");

open_form("modal_diskusi", "return save_data()");
   create_textarea("Pesan", "pesan", "richtextsimple");
close_form();
?>