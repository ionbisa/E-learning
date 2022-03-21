<script type="text/javascript" src="script/script_tugas_operator.js"> </script>

<?php
session_start();
if(empty($_SESSION['user']) or empty($_SESSION['pass'])){
 header('location: ../login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";

create_title("edit", "Manajemen Kelas Belajar Mengajar");

echo '<hr/><div class="alert alert-info"><p>Klik pada nama kelas untuk mengaktifkan atau menon-aktifkan KBM pada kelas tersebut!</p></div>';

create_table(array("Materi","Mapel","Kelas"));
?>
