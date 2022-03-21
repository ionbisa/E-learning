<html>
<head>

<title>E-Learning SMP Masa Depan</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/login.css"/>
	
<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>


<!-- tambah kode ini  -->
<script type = "text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>

<!-- sampai disini -->

<script type="text/javascript">
$(function(){
   $('.alert').hide();
   $('.login-form').submit(function(){
      $('.alert').hide();
      if($('input[name=username]').val() == ""){
         $('.alert').fadeIn().html('<b>Username</b> masih kosong!');
      }else if($('input[name=password]').val() == ""){
         $('.alert').fadeIn().html('<b>Password</b> masih kosong!');
      }else{
         $.ajax({
            type : "POST",
            url : "login_cek.php",
            data : $(this).serialize(),
            success : function(data){
               if(data == "ok") window.location = "index.php";	
               else $('.alert').fadeIn().html(data);	
            }
         });
      }
      return false;
   });
});
</script>
	
</head>
<body> 

<div class="container-fluid"> 	
	<div class="row">
		<div class="col-md-4 col-md-offset-4">

<div class="alert alert-danger" role="alert"> </div>
		
<div class="list-group">
   <div class="list-group-item active">
		<center><img src="../images/logo-tut.png" width="100" height="100"></center>
      <h3 class="text-center">E-Learning</h3>
      <h4 class="text-center"><b>SMP Masa Depan</b></h4>
      <h3 class="text-center">Portal Admin</h3>
   </div>
   <div class="list-group-item list-group-item-info">
				  
<form class="login-form">
	<div class="input-group">
		<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
		<input type="text" name="username" placeholder="Username" autofocus class="form-control">
	</div><br/>
	
	<div class="input-group">
		<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
		<input type="password" name="password" placeholder="Password" class="form-control">
	</div><br/>
	
	<button class="btn btn-primary pull-right login-button">
		<i class="glyphicon glyphicon-log-in"></i> Login
	</button><br/>
</form>
 
	</div>
</div>

		</div>
	</div>
</div>

</body>
</html>
