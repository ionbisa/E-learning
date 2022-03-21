<script type="text/javascript" src="js/tugas.js"></script>
<?php
session_start();
include "library/config.php"; 

if(empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}

//1 Update status siswa dan membuat array data untuk dimasukkan ke tabel nilai
mysqli_query($mysqli, "UPDATE siswa SET status='mengerjakan' WHERE nis='$_SESSION[nis]'");

$rtugas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas='$_GET[tugas]'"));
$qsoal = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_tugas='$_GET[tugas]' ORDER BY rand() LIMIT $rtugas[jml_soal]");

if(mysqli_num_rows($qsoal)==0) die('<div class="alert alert-warning">Belum ada soal pada tugas ini</div>');

$arr_soal = array();
$arr_jawaban = array();
while($rsoal = mysqli_fetch_array($qsoal)){
   $arr_soal[] = $rsoal['id_soal'];
   $arr_jawaban[] = 0;
}

$acak_soal = implode(",", $arr_soal);
$jawaban = implode(",", $arr_jawaban);

//2 Memasukkan data ke tabel nilai jika data nilai belum ada
$qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE nis='$_SESSION[nis]' AND id_tugas='$_GET[tugas]'");
if(mysqli_num_rows($qnilai) < 1){
   mysqli_query($mysqli, "INSERT INTO nilai SET nis='$_SESSION[nis]', id_tugas='$_GET[tugas]', acak_soal='$acak_soal', jawaban='$jawaban', sisa_waktu='$rtugas[waktu]:00'");
}

//3 Menampilkan judul mapel dan sisa waktu
$qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE nis='$_SESSION[nis]' AND id_tugas='$_GET[tugas]'");
$rnilai = mysqli_fetch_array($qnilai);
$sisa_waktu = explode(":", $rnilai['sisa_waktu']);

echo '<h3 class="page-header"><b>Mapel: '.$rtugas['nama_mapel'].' <span class="pull-right"> Sisa Waktu: <span class="menit">'.$sisa_waktu[0].'</span> : <span class="detik"> '.$sisa_waktu[1].' </span></span></b></h3>

<input type="hidden" id="tugas" value="'.$_GET['tugas'].'">
<input type="hidden" id="sisa_waktu">';
	
echo '<div class="row">
	<div class="col-md-8"><div class="konten-tugas">';	

//4 Mengambil data soal dari database
$arr_soal = explode(",", $rnilai['acak_soal']);
$arr_jawaban = explode(",", $rnilai['jawaban']);
$arr_class = array();

for($s=0; $s<count($arr_soal); $s++){
   $rsoal = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM soal WHERE id_soal='$arr_soal[$s]'"));

//5 Menampilkan no. soal dan soal	
   $no = $s+1;
   $soal = str_replace("../media", "media", $rsoal['soal']);
   $active = ($no==1) ? "active" : "";
   echo '<div class="blok-soal soal-'.$no.' '.$active.'">
<div class="box">
<div class="row">
   <div class="col-xs-1"><div class="nomor">'.$no.'</div></div>
   <div class="col-xs-11"><div class="soal">'.$soal.'</div> </div>
</div>';

//6 Membuat array pilihan dan mengacak pilihan
   $arr_pilihan = array();
   $arr_pilihan[] = array("no" => 1, "pilihan" => $rsoal['pilihan_1']);
   $arr_pilihan[] = array("no" => 2, "pilihan" => $rsoal['pilihan_2']);
   $arr_pilihan[] = array("no" => 3, "pilihan" => $rsoal['pilihan_3']);
   $arr_pilihan[] = array("no" => 4, "pilihan" => $rsoal['pilihan_4']);
   $arr_pilihan[] = array("no" => 5, "pilihan" => $rsoal['pilihan_5']);
   shuffle($arr_pilihan);

//7 Menampilkan pilihan	
   $arr_huruf = array("A","B","C","D","E");	
   $arr_class[$no] = ($arr_jawaban[$s]!=0) ? "green" : "";
   for($i=0; $i<=4; $i++){
      $checked = ($arr_jawaban[$s] == $arr_pilihan[$i]['no']) ? "checked" : "";
      $pilihan = str_replace("../media", "media", $arr_pilihan[$i]['pilihan']);
      echo '<div class="row pilihan">
<div class="col-xs-1 col-xs-offset-1">
   <input type="radio" name="jawab-'.$no.'" id="huruf-'.$no.'-'.$i.'" '.$checked.'>
   <label for="huruf-'.$no.'-'.$i.'" class="huruf" onclick="kirim_jawaban('.$s.', '.$arr_pilihan[$i]['no'].')"> '.$arr_huruf[$i].' </label>
</div>
<div class="col-xs-10">
   <div class="teks">'.$pilihan.' </div> 
</div>
</div>';
   }

//8 Menampilkan tombol sebelumnya, ragu-ragu dan berikutnya
   echo '</div><br/><div class="row"><div class="col-md-3">';
   
   $sebelumnya = $no-1;
   if($no != 1) echo '<a class="btn btn-primary btn-blockl" onclick="tampil_soal('.$sebelumnya.')">Sebelumnya</a>';
   echo '</div>
   <div class="col-md-4 col-md-offset-1"><label class="btn btn-warning btn-block"> <input type="checkbox" autocomplete="off" onchange="ragu_ragu('.$no.')"> Ragu-ragu </label></div>	
<div class="col-md-3 col-md-offset-1">';
	
   $berikutnya = $no+1;
   if($no != count($arr_soal)) echo '<a class="btn btn-primary btn-block" onclick="tampil_soal('.$berikutnya.')"> Berikutnya </a>';
   else echo '<a class="btn btn-danger btn-block" onclick="selesai()"> Selesai </a>';

   echo '</div></div></div>';
}

echo '</div></div>
	<div class="col-md-4"><div class="nomor-tugas">';

//9 Menampilkan nomor tugas
for($j=1; $j<=$s; $j++){
   echo '<div class="blok-nomor"><div class="box"> <a class="tombol-nomor tombol-'.$j.' '.$arr_class[$j].'" onclick="tampil_soal('.$j.')">'.$j.'</a></div></div>';
}
echo '</div></div></div>';

//10 Menampilkan modal ketika selesai tugas
echo '<div class="modal fade" id="modal-selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
   <form  onsubmit="return selesai_tugas('.$_GET['tugas'].')">
      
<div class="modal-header">
  <h3 class="modal-title">Selesai tugas</h3>
</div>
		
<div class="modal-body">
   <p>Pastikan semua soal telah dikerjakan sebelum mengklik selesai. Setelah klik selesai Anda tidak dapat mengerjakan tugas lagi. Yakin akan menyelesaikan tugas? </p>
   <div class="chekbox-selesai"><input type="checkbox" required> Saya yakin akan menyelesaikan tugas.</div>
</div>
		
<div class="modal-footer">
   <button type="submit" class="btn btn-danger" onclick="return selesai_tugas('.$_GET['tugas'].')"> Selesai </button>
   <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal </button>
</div>
		
</form></div></div></div>';
?>
