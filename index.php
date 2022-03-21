<?php
session_start();
ob_start();

//Mengecek status login
if(empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['siswa'])){
   header('location: login.php');
}
include("library/config.php");
?>

<html>
<head>
   <title>E-Learning SMP Negeri 2 Bongas</title>

   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width,initial-scale=1" />

   <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
   <link type="text/css" rel="stylesheet" href="assets/dataTables/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/style.css"/>
   <link rel="shortcut icon" type="image/png" href="images/logo-tut.png" >
	
   <script type="text/javascript" src="assets/jquery/jquery-2.0.2.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/main.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top"> 
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

</body>
</html>
