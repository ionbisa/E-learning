<?php
include "../../library/config.php";
$rtugas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas='$_GET[tugas]'"));
$rkelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'"));
//header("Content-type: application/vnd-ms-excel");
header("Content-Type:application/vnd.ms-excel; charset=utf-8");
header("Content-type:application/x-msexcel; charset=utf-8");
$fn = "Nilai_".str_replace(" ","_",$rtugas['nama_mapel'])."_Kelas_".str_replace(" ","_",$rkelas['kelas']).".xls";
//var_dump($fn);die;
header("Content-Disposition: attachment; filename=$fn");
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password'])
or $_SESSION['leveluser']!="guru"){
header('location: ../login.php');
}
echo '<table>
<tr>
<td>No</td>
<td>NIS</td>
<td>Nama Siswa</td>
<td>Jml. Benar</td>
<td>Nilai</td>
</tr>';
$query = mysqli_query($mysqli, "SELECT * FROM siswa WHERE id_kelas='$_GET[kelas]'");
$no = 1;
while($r = mysqli_fetch_array($query)){
$n = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE nis='$r[nis]' AND id_tugas='$_GET[tugas]'"));
echo '<tr>
<td>'.$no.'</td>
<td>'.$r['nis'].'</td>
<td>'.$r['nama'].'</td>
<td>'.$n['jml_benar'].'</td>
<td>'.$n['nilai'].'</td>
</tr>';
$no++;
}
echo '</table>';