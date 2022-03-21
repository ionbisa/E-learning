<?php
session_start();
?>
<script type = "text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>

<?php

if(empty($_SESSION['user_adm']) or empty ($_SESSION['pass_adm'])){
   header('location: login.php');
}
$jk="";
if($_SESSION['jk_adm']=="Laki-Laki"){
	$jk="Bapak";
}else{
	$jk="Ibu";
}
?>


<div class="jumbotron">
   <div class="container text-center">
      <h2>Selamat Datang <?php echo $jk;?> <b> <?= $_SESSION['nama_adm']; ?> </b>!</h2>
      <p>Anda login sebagai <b> Administrator </b></p>
   </div>
</div>
<h1 class="text-center"> VISI DAN MISI</h1>
<h3 class="text-center">Visi</h3>
<h4>Terwujudnya Peserta Didik Yang Berakhlak, Kreatif, Berprestasi dan Berkarakter</h4>

<h3>Misi</h3>
<ol>
   <li>Menciptakan Lingkungan Pendidikan Yang   Agamis</li>
   <li>Melaksanakan Pembelajaran Dan Bimbingan Yang Efektif, Kreatif,  Dan Inovatif</li>
   <li>Mewujudkan  Prestasi Akademis Dan Nonakademis</li>
   <li> Menumbuhkan Nilai-Nilai  Sosial Budaya Dan Karakter Pada Diri Peserta Didik</li>
   <li>embangun Prestasi Kerja Dengan Dilandasi  Keteladanan</li>
   <li>Memiliki Sarana/Fasilitas  Yang Memadai</li>
   <li>Mewujudkan Budaya Mutu Lingkungan Sehat  Dengan Pola Hidup Bersih Dan Sehat</li>
</ol>
