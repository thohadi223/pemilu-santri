<?php
	require_once('config/connection.php');
	$query = "SELECT * FROM kandidat";
	$result = $mysqli->query($query);
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
	<!--<link href="css/normalize.css" rel="stylesheet">-->
	
	<style>
		body{
			background-color:#333;
		}
		h1{
			font-family:Ubuntu-Bold, Arial, Sans-Serif;
			color:#fff;
			font-size:80px;
			margin-bottom: 5px;
		}
		h2{
			font-family:Ubuntu-Medium, Arial, Sans-Serif;
			color:#fff;
			font-size:50px;
		}
		form{
			margin:80px auto 5px;
		}
		#error_msg{
			height:20px;
			font-weight:bold;
			color: #fff;
		}
	</style>
  </head>

  <body>
    <div class="container">

		<div class="text-center">
			<h1>PEMILIHAN PRESIDEN</h1>
			<h2>ORGANISASI PELAJAR AL-ZAYTUN</h2>
			<h2>2016 M - 1438 H</h2>
			<div>
			<img src="images/az-logo.png" alt="Logo AL-ZAYTUN">
			</div>
			<form action="" method="get" id="frmlogin" name="frmlogin" class="col-lg-6 col-lg-offset-3">
			<p id="error_msg"><p>
			  <div class="form-group">
				<div class="input-group input-group-lg">
				  <input type="text" class="form-control" name="kode-pemilih" id="kode-pemilih" autofocus placeholder="Masukkan No. Induk">
				  <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
				</div>
			  </div>
			  <div class="form-group">
			  
				
				<div class="input-group input-group-lg">
				  
				  <input type="text" class="form-control" name="password-pemilih" id="password-pemilih" autofocus placeholder="Masukkan Tgl Lahir">
				  <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
				</div>
				<p style="color:#fff" class="help-block">Contoh: jika tanggal lahir 13 Juli 1990, masukkan 13071990</p>
				
			</div>
				<button type="submit" name="btn-go" id="btn-go" class="btn btn-lg btn-primary">			  
			  LANJUTKAN </button>
			  <!--<button type="button" name="btn-go" id="btn-go" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#mymodal">-->
				
			</form>
			<div id="loader" class="hidden text-center">
				<img src="images/282.gif">
			</div>
		</div>
		
    </div><!-- /.container -->
	<div class="modal fade" id="mymodal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Konfirmasi Identitas Pemilih</h4>
		  </div>
		  <div class="modal-body">
			<p>Selamat Datang,</p>
			<div id="data-pemilih" class="bg-warning">
				<ul style="padding:10px 40px">
					<li><label>No. Induk :</label> <span id="no-induk"></span></li>
					<li><label>Nama :</label> <span id="nama"></span></li>
					<li><label>Kelas :</label> <span id="kelas"></span></li>
				</ul>
			
			</div>
			<p>Jika data identitas diri di atas sudah sesuai dengan identitas Anda, klik <strong>Lanjutkan</strong> untuk masuk ke tahap berikutnya.</p>
			<p>Jika data identitas yang tampil tidak sesuai, harap menghubungi petugas.</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary" id="btn-next">Lanjutkan</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    <?php include('js.html'); ?>

	<script>
		$(function(){
			$('#btn-next').click(function(){
				var kodePemilih = $('#kode-pemilih').val();
				window.location.href='election.php?token='+kodePemilih;
			});
			$('#frmlogin').submit(function(e){
				e.preventDefault();
				var kodePemilih = $('#kode-pemilih').val();
				var passwordPemilih = $('#password-pemilih').val();
				$('#loader').removeClass('hidden');
				$.post('validate_pemilih.php',{kodePemilih:kodePemilih,passwordPemilih:passwordPemilih},
					function(json,status){
						
						$('#loader').addClass('hidden');
							
						if(json!=null){
							if(json['error']!=null){
								$('.form-group').removeClass('has-success');
								$('.form-group').addClass('has-error');
								$('#error_msg').text(json['error']);
							}else{
								$('.form-group').removeClass('has-error');
								$('.form-group').addClass('has-success');
								$('#error_msg').text('');
								
								$('#no-induk').text(json['no_induk']);
								$('#nama').text(json['nama']);
								$('#kelas').text(json['kelas']);
								
								$('#mymodal').modal({
								  keyboard: false,
								  backdrop: 'static'
								});
							}
						}else{
							$('.form-group').removeClass('has-success');
							$('.form-group').addClass('has-error');
							$('#error_msg').text('Kode yang Anda masukkan tidak terdaftar');
							
						}
							
					},
				'json');
				
				
				
			});
		})
	</script>
  </body>
  
</html>
