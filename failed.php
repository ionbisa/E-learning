<html>
<head>

<title>E-Learning SMK Ad-Da'wah Jakarta</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/login.css"/>
	
<script type="text/javascript" src="assets/jquery/jquery-2.0.2.min.js"></script>

</head>
<body>

<div class="container-fluid"> 	
	<div class="row">
		<div class="col-md-12 text-center">
		<h2>Kode unik tidak sah</h2>
		<?php
		include("library/config.php");
		if($_SESSION['leveluser'] != "admin"){
			$hume = $url_website . '/admin/';
		}else{
			$hume = $url_website;
		}
		?>
		<a href="<?php echo $hume;?>">Kembali</a>
		</div>
	</div>
</div>

</body>
</html>
