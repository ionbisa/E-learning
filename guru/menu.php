<div class="navbar-header">
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
   </button>
	<h5 align="center">
		<img src="../images/logo-tut.png" width="30" height="30">
		<font color="black" style="bold">E-Learning SMP Negeri 2 Bongas</font>
	</h5>
</div>

<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">

<?php
	
function menu_admin($link, $icon, $title){
   $item = '<li><a href="'.$link.'" class="navigation"><i class="glyphicon glyphicon-'.$icon.'"></i> '.$title.'</a></li>';
   return $item;
}
   echo menu_admin("home.php", "home", "Beranda");
   echo menu_admin("view/view_materi_teacher.php", "list-alt", "KBM");
    echo menu_admin("view/view_tugas_teacher.php", "edit", "Ujian");
   echo menu_admin("view/view_tugas_operator.php", "edit", "Kelas");
?>

   </ul>
   <ul class="nav navbar-nav navbar-right">

<?php
   echo menu_admin("view/view_profil.php", "user", $_SESSION['nama']);
   echo menu_admin("logout.php", "off", "Keluar");
?>

   </ul>
</div>
