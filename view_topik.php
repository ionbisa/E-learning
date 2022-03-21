<?php
session_start();
include "library/config.php";
include "library/function_date.php";

if( empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}

echo '<h3 class="page-header">Daftar Materi Belajar</h3>';
echo '<hr/><div class="alert alert-info"><ul>
<li>Kelas Belajar Mengajar (KBM) ini untuk informasi materi dan Tugas Untuk Siswa!</li>
<li>Klik tombol Download pada kolom Download Materi untuk men-download materi!</li>
<li>Klik tombol Diskusi pada kolom Diskusi untuk melihat diskusi & Absensi!</li>
</ul></div>';
/*Cek jumlah tugas pada tanggal sekarang
$tgl = date('Y-m-d');
$qtugas = mysqli_query($mysqli, "SELECT * FROM tugas t1, kelas_tugas t2 WHERE t1.id_tugas=t2.id_tugas AND t2.id_kelas='$_SESSION[kelas]' SORT BY id_tugas DESC");
$ttugas = mysqli_num_rows($qtugas);
$rtugas = mysqli_fetch_array($qtugas);
*/
   echo '<table class="table table-striped"><thead>
   <tr>
      <th>No</th>
      <th>Nama Mapel</th>
      <th>Materi</th>
      <th>Dowlnoad Materi</th>
      <th>Tanggal</th>
      <th>Diskusi/Absensi</th>
   </tr></thead>
   <tbody>';
   $qtugas = mysqli_query($mysqli, "SELECT * FROM tugas t1, kelas_tugas t2 WHERE t1.id_tugas=t2.id_tugas AND t2.id_kelas='$_SESSION[kelas]' ORDER BY t1.id_tugas DESC");
   $no = 1;
   while($r = mysqli_fetch_array($qtugas)){
      
      $jadwal_kelas = array();
      $qjadwal_kelas = mysqli_query($mysqli, "SELECT * FROM kelas t1, kelas_tugas t2 WHERE  t1.id_kelas=t2.id_kelas AND t2.id_tugas='$r[id_tugas]'");
      while($rku = mysqli_fetch_array($qkelas_tugas)){
         $kelas_tugas[] = $rku['kelas'];
      }
	  $labeldiskusi="";
	  $qdiskusi = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_kelas ='$_SESSION[kelas]' AND id_tugas='$r[id_tugas]'");
	  $jmldiskusi = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_tugas='$r[id_tugas]' AND id_kelas='$_SESSION[kelas]'"));
	  $labeldiskusi .= '<a class="btn btn-xs btn-info" style="margin-bottom: 5px" onclick="show_diskusi('.$_SESSION['kelas'].','.$r['id_tugas'].')">Diskusi &nbsp;&nbsp; <span class="label label-warning">'.$jmldiskusi.'</span></a> ';
	  $download = "guru/upload/".$r['materi'];
	  $labeldownload="";
      $labeldownload .= '<a href='.$download.' class="btn btn-xs btn-info" target="_blank" style="margin-bottom: 5px">Download</a>';
	  echo'<tr>
         <td>'.$no.'</td>
         <td>'.$r['nama_mapel'].'</td>
         <td>'.$r['topik'].'</td>';
		 if($r['materi']==""){
			 echo '<td>Belum Ada Materi</td>';
		 }else{
			echo '<td>'.$labeldownload.'</td>';
		}
	echo'
         <td>'.tgl_indonesia($r['tanggal']).'</td>
         <td>'.$labeldiskusi.'</td>
     </tr>';
	 $no++;
  }

   echo '</tbody></table>';
//}
?>
