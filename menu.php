 <div class="navbar-header">
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
   </button>
	<h5 align="center">
		<img src="images/logo-tut.png" width="30" height="30">
		<font color="white" style="bold">E-Learning SMP Negeri 2 Bongas</font>
	</h5>
</div>

<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">

<?php
	
function menu_siswa($link, $icon, $title){
   $item = '<li><a href="'.$link.'" class="navigation"><i class="glyphicon glyphicon-'.$icon.'"></i> '.$title.'</a></li>';
   return $item;
}

   echo menu_siswa("home.php", "home", "Beranda");
   echo menu_siswa("view_topik.php", "list-alt", "KBM");
   echo menu_siswa("view_tugas.php", "list-alt", "Tugas");
   echo menu_siswa("view_nilai.php", "list-alt", "Nilai");
?>

   </ul>
   <ul class="nav navbar-nav navbar-right">

<?php
   echo menu_siswa("profil.php", "user", $_SESSION['namalengkap']);
   echo menu_siswa("logout.php", "off", "Keluar");
?>

   </ul>
</div>
