<script type="text/javascript" src="script/script_tugas_teacher.js"> </script>

<?php
session_start();
if(empty($_SESSION['user']) or empty($_SESSION['pass'])){
   header('location: login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";

create_title("edit", "Manajemen KBM");

echo '<hr/><div class="alert alert-info"><ul>
<li>Klik tombol edit pada kolom Bank Soal untuk mengatur soal!</li>
<li>Klik nama kelas pada kolom Kelas tugas untuk melihat nilai pada kelas tersebut!</li>
<li>Klik tombol Diskusi pada kolom Diskusi untuk melihat diskusi & Absensi!</li>
</ul></div>';

create_table(array("Materi", "Nama Mapel", "Tanggal", "Jml.Soal", "Materi","Bank Soal", "Kelas","Diskusi"));
?>