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
	<link href="css/normalize.css" rel="stylesheet">

    <style>
		h1,h3{
			font-family:Ubuntu-Medium, Arial, Sans-Serif;
			color:#333;
		}
		.modal-dialog{
			width:400px;
		}
		
	</style>
  </head>

  <body>

    <div class="container">

		<div class="text-center">
			<h1>PEMILIHAN PRESIDEN ORGANISASI PELAJAR AL-ZAYTUN</h1>
			<h1>TAHUN 2015 M/ 1437 H</h1>
		</div>
		<div class="row">
		<?php
		$i=0;
		while($kandidat = $result->fetch_array()){
			$concated_values = $kandidat['no_urut'].';'.$kandidat['no_induk'].';'.$kandidat['nama'];
			$i++;
		?>
			<div class="col-md-2 text-center <?php if($kandidat['no_urut']==1){?>col-md-offset-1<?php } ?>">
			<h4><?php echo $kandidat['no_urut']; ?></h4>
				<div class="view view-first">
					
					<img src="kandidat/<?php echo $kandidat['foto']; ?>" style="width:100%;height:100%" alt="<?php echo $kandidat['foto']; ?>">
					
					<div class="mask">
						<!--<h2>Hover Style #1</h2>-->
						<input type="hidden" class="info-kandidat" value="<?php echo $concated_values; ?>">
						<a href="javascript:void(0)" class="info">
							<button type="button" class="btn btn-success" class="btn-pilih" name="pilih">
							<span class="glyphicon glyphicon-ok"></span>
								<strong>PILIH</strong>
							</button>
						</a>
					</div>
				</div>
				<h5><?php echo $kandidat['nama']; ?></h5>
			</div>
		<?php
			if($i==5)
				break;
		}
		?>
		</div>
		<div class="row">
			
			<?php
		$i=0;
		while($kandidat = $result->fetch_array()){
			$concated_values = $kandidat['no_urut'].';'.$kandidat['no_induk'].';'.$kandidat['nama'];
			$i++;
		?>
			<div class="col-md-2 text-center <?php if($kandidat['no_urut']==6){?>col-md-offset-1<?php } ?>">
			<h4><?php echo $kandidat['no_urut']; ?></h4>
				<div class="view view-first">
					
					<img src="kandidat/<?php echo $kandidat['foto']; ?>" style="width:100%;height:100%" alt="<?php echo $kandidat['foto']; ?>">
					
					<div class="mask">
						<!--<h2>Hover Style #1</h2>-->
						
						<input type="hidden" class="info-kandidat" value="<?php echo $concated_values; ?>">
						<a href="javascript:void(0)" class="info">
							<button type="button" class="btn btn-success" class="btn-pilih" name="pilih">
							<span class="glyphicon glyphicon-ok"> </span>
								<strong> PILIH</strong>
							</button>
						</a>
					</div>
				</div>
				<h5><?php echo $kandidat['nama']; ?></h5>
			</div>
		<?php
			if($i==5)
				break;
		}
		?>
		</div>
    </div><!-- /.container -->
	
	<div class="modal fade" id="mymodal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Konfirmasi Pilihan Kandidat</h4>
		  </div>
		  <div class="modal-body">
		  
		  <form class="text-center" name="frmkandidat" id="frmkandidat" method="post" action="proses_pilihan.php">
			<input type="hidden" name="kandidat" class="selected-no-urut">
			<input type="hidden" id="kode" name="kode" value="<?php echo $_GET['token']; ?>">
			<h1 class="selected-no-urut">-</h1>
			<img class="thumbnail center-block" id="selected-kandidat" src="" style="width:300px">
			
					
			<h3><span id="selected-nama"></span><br><span id="selected-no-induk"></span></h3>
			
		  </form>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
			<button type="button" class="btn btn-success" id="btn-ya"><i class="glyphicon glyphicon-ok"></i> Ya</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php include('js.html'); ?>
	<script>
		$(function(){
			$('.info').click(function(){
				var imgSrc = $(this).parent().prev().attr('src');
				var details = $(this).prev().val().split(";");
				
				$('#selected-kandidat').attr('src',imgSrc);
				$('h1.selected-no-urut').text(details[0]);
				$('input.selected-no-urut').val(details[0]);
				$('#selected-no-induk').text(details[1]);
				$('#selected-nama').text(details[2]);
				
				$('#mymodal').modal({
					keyboard:false,
					backdrop: 'static'
				})
			})
			$('#btn-ya').click(function(){
				$('#frmkandidat').submit();
			})
		})
	
	</script>
  </body>
</html>
