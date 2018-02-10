<?php
	require_once('config/connection.php');
	$message="";
	if(isset($_POST['kode']) && isset($_POST['kandidat'])){
		try{
			$kode = $_POST['kode'];
			$kandidat = $_POST['kandidat'];
			
			$query = "INSERT INTO suara_pemilih (kode_pilih,kandidat) VALUES (?,?)";
			$pstm = $mysqli->prepare($query);
			$pstm->bind_param('si',$kode,$kandidat);
			$pstm->execute();
			
			$query = "UPDATE pemilih SET status=1 WHERE no_induk = ?";
			$pstm_update = $mysqli->prepare($query);
			$pstm_update->bind_param('s',$kode);
			echo 'kode'.$kode;
			if(!$pstm_update->execute()){
				throw new Exception($mysqli->error);
			};
			header('location:thanks.php');
		}catch(Exception $e){
			$message = $e->getMessage();
			
		}
	}else{
		header('location:index.php');
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
    <link rel="icon" href="favicon.ico">

    <title>Pemilihan Presiden OPAZ</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
	<link href="css/style1.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	
	<style>
		h1{
			font-family:Ubuntu-Bold, Arial, Sans-Serif;
			margin-bottom: 5px;
		}
		h2{
			font-family:Ubuntu-Medium, Arial, Sans-Serif;
			
		}
		#message{
			margin:100px auto 5px;
		}
		.help-block{
			font-weight:bold;
		}
	</style>
  </head>

  <body>
    <div class="container">

		<div class="text-center">
			<h1>PEMILIHAN PRESIDEN</h1>
			<h2>ORGANISASI PELAJAR AL-ZAYTUN</h2>
			<h2>2015 M - 1437 H</h2>
			<div id="message">
			  <h2 class="text-danger">ERROR <?php echo $message; ?> </h2>
			  <p>Silakan Hubungi Petugas Kami</p>
			  <!--<button type="button" name="btn-go" id="btn-go" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#mymodal">-->
				
			</div>
			<ul class="pager">
                            <li><a href="index.php">← Coba Lagi</a></li>
                        </ul>
		</div>
		
    </div><!-- /.container -->
	
    
  </body>
  
</html>
