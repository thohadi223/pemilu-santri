<?php
	session_start();
	$message = "";
	if(isset($_POST['btn-login'])){
		if($_POST['username']=='superadmin' && $_POST['password']=='P@ssw0rd'){
			$_SESSION['admin']='ADMIN';
			header('location:index.php');
		}else{
			$message = "user atau password salah";
		}
			
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../favicon.ico">

		<title>Pemilihan Presiden OPAZ</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
	</head>
	<body>
		<div style="margin:40px auto" class="container">
			<p class="text-center"><?php echo $message; ?></p>
			<form class="form-horizontal" method="post" name="frmlogin" action="" style="width:50%;margin:50px auto">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="user" name="username" placeholder="Username">
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
					  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" name="btn-login" class="btn btn-primary">Sign in</button>
					</div>
				  </div>
			</form>
		</div>
	</body>
</html>