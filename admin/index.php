<?php
session_start();
ob_start();

//Mengatur batas login
$timeout = $_SESSION['timeout'];
if(time()<$timeout){
   $_SESSION['timeout'] = time()+5000;
}else{
   $_SESSION['login'] = 0;
}

include("../library/config.php");
//Mengecek status login
if(empty($_SESSION['user_adm']) or empty($_SESSION['pass_adm']) or $_SESSION['login']==0){
   header('location: login.php');
}
?>

<html>
<head>
   
<title>E-Learning SMP Negeri 2 Bongas</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="../assets/dataTables/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
   
<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
<link rel="shortcut icon" type="image/png" href="../images/logo-tut.png" >
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top"> 
   <div class="container">
      <?php include "menu.php"; ?> 
   </div>
</nav>   

<section>   
   <div  class="container">
      <div class="row">
         <div class="col-xs-12" id="content"></div>
      </div>
   </div>
</section>

<footer> 
   <div class="container">
      <p class="text-center">E-Learning SMP Negeri 2 Bongas Indramayu</p>
   </div>
</footer>
   
<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="../js/admin.js"></script>

</body>
</html>
