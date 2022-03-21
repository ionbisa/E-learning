<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}
?>

<h3 class="page-header"><i class="glyphicon glyphicon-exclamation-sign"></i> Petunjuk Mengerjakan</h3>
<div class="alert alert-info">
<p>Sebelum mengerjakan ulangan online, baca dengan cermat petunjuk berikut:</p>

<ul>	
<li>Berdoalah terlebih dahulu sebelum mengerjakan tugas! </li>
<li>Gunakan nomor soal di sebelah kanan atau tombol di bawah soal untuk pindah ke lain soal! </li>
<li>Nomor berwarna merah berarti belum dikerjakan, nomor berwarna kuning berarti ragu-ragu, dan tombol berwarna hijau berarti telah dikerjakan. </li>
<li>Jawaban yang dipilih akan berubah berwarna hijau. Jawaban dapat diganti dengan mengklik pilihan lain. </li>
<li>Kerjakan soal yang paling mudah terlebih dahulu. </li>
<li>Selesaikan semua soal sebelum waktu habis! Jika waktu habis, maka soal otomatis tidak dapat dikerjakan lagi.</li>
<li>Klik tombol Selesai pada nomor terakhir untuk mengakhiri tugas. Pastikan telah mengklik tombol ini sebelum logout.</li>
</ul>

</div>

<form onsubmit="return show_tugas(<?= $_GET['tugas']; ?>)" class="form">
<div class="form-group">
   <div class="col-md-9">
      <input type="checkbox" required><b> Saya telah membaca dan memahami petunjuk mengerjakan dengan cermat</b> 
   </div>
   <div class='col-md-3'>
      <button type="submit" class="btn btn-warning"> <i class="glyphicon glyphicon-log-in"></i> Mulai Mengerjakan </button>
   </div>
</div>
</form>
