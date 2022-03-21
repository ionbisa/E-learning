<?php
session_start();
include "library/config.php";
include "library/function_date.php";

if( empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}

echo '<h3 class="page-header">Daftar Tugas</h3>';

//Cek jumlah tugas pada tanggal sekarang
$tgl = date('Y-m-d');
$qtugas = mysqli_query($mysqli, "SELECT * FROM tugas t1, kelas_tugas t2 WHERE t1.id_tugas=t2.id_tugas AND t2.id_kelas='$_SESSION[kelas]' AND t2.aktif='Y' AND t1.tanggal='$tgl'");
$ttugas = mysqli_num_rows($qtugas);
$rtugas = mysqli_fetch_array($qtugas);

/*Jika tidak ada tugas aktif tampilkan pesan*/
if($ttugas < 1){
   echo '<div class="alert alert-info">Belum ada tugas yang aktif saat ini. Silahkan hubungi operator!</div>';
}

//Jika ada satu tugas aktif arahkan ke halaman berikutnya
else if($ttugas == 1){
   echo '<script> show_detail('.$rtugas['id_tugas'].'); </script>';
}

//Jika ada dua atau lebih tugas aktif tampilkan pada tabel
else{
   echo '<table class="table table-striped"><thead>
   <tr>
      <th>No</th>
      <th>Materi</th>
      <th>Nama Mapel</th>
      <th>Kelas</th>
      <th>Tanggal</th>
      <th>Jml. Soal</th>
      <th>Waktu</th>
      <th>Aksi</th>
   </tr></thead><tbody>';
	
	$qtugas = mysqli_query($mysqli, "SELECT * FROM tugas t1, kelas_tugas t2 WHERE t1.id_tugas=t2.id_tugas AND t2.id_kelas='$_SESSION[kelas]' AND t2.aktif='Y'");
   $no = 1;
   while($r = mysqli_fetch_array($qtugas)){
      
      $kelas_tugas = array();
      $qkelas_tugas = mysqli_query($mysqli, "SELECT * FROM kelas t1, kelas_tugas t2 WHERE  t1.id_kelas=t2.id_kelas AND t2.id_tugas='$r[id_tugas]'");
      while($rku = mysqli_fetch_array($qkelas_tugas)){
         $kelas_tugas[] = $rku['kelas'];
      }
		
      echo'<tr>
         <td>'.$no.'</td>
         <td>'.$r['topik'].'</td>
         <td>'.$r['nama_mapel'].'</td>
         <td>'.implode($kelas_tugas, ", ").'</td>
         <td>'.tgl_indonesia($r['tanggal']).'</td>
         <td>'.$r['jml_soal'].'</td>
        <td>'.$r['waktu'].' menit</td>
        <td>';
	
//Jika nilai sudah ada tampilkan tombol Sudah Mengerjakan, jika belum ada tampilkan tombol Kerjakan
        $qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_tugas='$r[id_tugas]' AND nis='$_SESSION[nis]'");
        $tnilai = mysqli_num_rows($qnilai);
        $rnilai = mysqli_fetch_array($qnilai);

        if($tnilai>0 and $rnilai['nilai'] != "") echo '<a class="btn btn-danger">Sudah Mengerjakan</a>';
        else echo '<a onclick="show_detail('.$r['id_tugas'].')" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i>Kerjakan</a>';
        echo '</td>
     </tr>';
	 $no++;
  }

   echo '</tbody></table>';
}
?>
