<?php
session_start();
ob_start();

//Mengecek status login
if(empty($_SESSION['user']) or empty($_SESSION['pass']) or $_SESSION['login']==0){
   header('location: login.php');
}
include("../library/config.php");
?>

<html>
<head>
   
<title>Halaman Administrator</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>

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
         <div class="col-xs-12" style="margin-top:60px">
			<form action="cari.php" method="post" role="form">
				<div class="form-group">
					<label for="email">Kata pencarian:</label>
					<input type="text" class="form-control" name="cari" autocomplete="off">
				</div>
				<button name="submit" type="submit" class="btn btn-primary">Submit</button>
			</form>
			<?php
			if(isset($_POST['submit'])){
				if(isset($_POST['edit_soal'])){
					//echo '<pre>';
					//print_r($_POST);die;
					$id_soal = $_POST['id_soal'];
					$soal = addslashes($_POST['soal']);
					$pil1 = addslashes($_POST['pilihan_1']);
					$pil2 = addslashes($_POST['pilihan_2']);
					$pil3 = addslashes($_POST['pilihan_3']);
					$pil4 = addslashes($_POST['pilihan_4']);
					$pil5 = addslashes($_POST['pilihan_5']);
					$kunci = addslashes($_POST['kunci']);
					include "../library/config.php";
					mysqli_query($mysqli, "UPDATE soal SET soal='$soal',pilihan_1='$pil1',pilihan_2='$pil2',pilihan_3='$pil3',pilihan_4='$pil4',pilihan_5='$pil5',kunci='$kunci' WHERE id_soal='$id_soal'");
					header('location: index.php');
				}else{
					include "../library/config.php";
					$cari = $_POST['cari'];
					if(empty($cari)){
						header('location: cari.php');
					}
					$query = mysqli_query($mysqli, "SELECT *,(SELECT nama_mapel FROM tugas WHERE soal.id_tugas=tugas.id_tugas) as nama_mapel FROM soal WHERE soal LIKE '%$cari%'");
					echo '<table class="table">';
					echo '<tr>';
					echo '<th>id_soal</th>';
					echo '<th>soal</th>';
					echo '<th>mapel</th>';
					echo '<th>aksi</th>';
					echo '</tr>';
					while($r = mysqli_fetch_array($query)){
						echo '<tr>';
						echo '<td>'.$r['id_soal'].'</td>';
						echo '<td>'.$r['soal'].'</td>';
						echo '<td>'.$r['nama_mapel'].'</td>';
						echo '<td><a href="cari.php?id_soal=' . $r['id_soal'] . '">Edit</a></td>';
						echo '</tr>';
					}
					echo '</table>';
				}
			}
			if($_GET['id_soal']){
				echo '<script type="text/javascript" src="../assets/tinymce/tinymce.min.js"> </script>';
				include "../library/config.php";
				$id_soal = $_GET['id_soal'];
				$query = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_soal='$id_soal'");
				echo '<form action="cari.php" method="post" role="form">';
				while($r = mysqli_fetch_array($query)){
					echo '<label>Soal</label>';
					echo '<textarea name="soal" class="form-control">'.$r['soal'].'</textarea>';
					echo '<label>Pilihan 1</label>';
					echo '<textarea name="pilihan_1" class="form-control">'.$r['pilihan_1'].'</textarea>';
					echo '<label>Pilihan 2</label>';
					echo '<textarea name="pilihan_2" class="form-control">'.$r['pilihan_2'].'</textarea>';
					echo '<label>Pilihan 3</label>';
					echo '<textarea name="pilihan_3" class="form-control">'.$r['pilihan_3'].'</textarea>';
					echo '<label>Pilihan 4</label>';
					echo '<textarea name="pilihan_4" class="form-control">'.$r['pilihan_4'].'</textarea>';
					echo '<label>Pilihan 5</label>';
					echo '<textarea name="pilihan_5" class="form-control">'.$r['pilihan_5'].'</textarea>';
					echo '<label>Jawaban</label>';
					echo '<input name="kunci" class="form-control" value="'.$r['kunci'].'">';
					echo '<input type="hidden" name="id_soal" value="'.$r['id_soal'].'">';
				}
				echo '<br>';
				echo '<input type="hidden" name="edit_soal">';
				echo '<button name="submit" type="submit" class="btn btn-primary">Submit</button>';
				echo '</form>';
			}
			?>
		 </div>
      </div>
   </div>
</section>

<footer> 
   <div class="container">
      <p class="text-center"><?php echo $myid['nama'];?></p>
   </div>
</footer>
	
<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/js/dataTables.bootstrap.min.js"></script>
<script>
	tinyMCE.init({
		selector: "textarea",
		height: 150,
		plugins: [
		"advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste imagetools responsivefilemanager tiny_mce_wiris"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager tiny_mce_wiris_formulaEditor",
		
		external_filemanager_path:"../assets/filemanager/",
		filemanager_title:"File Manager" ,
		external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
	});
</script>

</body>
</html>
