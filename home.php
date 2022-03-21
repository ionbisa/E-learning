<?php
session_start();
?>
<script type = "text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>

<?php

if(empty($_SESSION['username']) or empty ($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}
?>


<div class="jumbotron">
   <div class="container text-center">
      <h2>Selamat Datang,<b> <?= $_SESSION['nis']; ?> - <?= $_SESSION['namalengkap']; ?> </b>!</h2>
   </div>
</div>
