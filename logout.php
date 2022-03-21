<?php
  session_start();
  include "library/config.php";  
  session_destroy();
  echo "<script>
   alert('Anda keluar dari halaman siswa!'); 
   window.location = 'login.php';
   </script>";
?>
