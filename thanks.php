
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
			margin:200px auto 5px;
		}
		.help-block{
			font-weight:bold;
		}
	</style>
  </head>

  <body>
    <div class="container">

		<div class="text-center">
			<h1>PEMILIHAN PRESIDEN ORGANISASI PELAJAR AL-ZAYTUN</h1>
			<h2>2016 M - 1438 H</h2>
			<div id="message">
			  <h2 style="font-size:60px;" class="text-success">TERIMA KASIH ATAS PARTISIPASI ANDA</h2>
			  <h2 style="font-size:50px;" class="text-success">Silakan Kembali Ke Tempat Duduk Semula</h2>
			  <p>You will be redirected to home page in a moment ...</p>
			  <!--<button type="button" name="btn-go" id="btn-go" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#mymodal">-->
				
			</div>
		</div>
		
    </div><!-- /.container -->
	<?php include('js.html');?>
	
	<script>
		$(function(){
			setInterval(function(){
                    window.location.href='index.php';
                }, 5000);
		});
	</script>
    
  </body>
  
</html>
