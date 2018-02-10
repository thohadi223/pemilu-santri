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
		/*.modal-dialog{
			width:400px;
		}*/
		#frmkandidat h1{
			font-size: 40px;
			margin: 5px auto;
		}
		
	</style>
  </head>

  <body>

    <div class="container">

		<div class="text-center">
			<h1>PEMILIHAN PRESIDEN ORGANISASI PELAJAR AL-ZAYTUN</h1>
			<h1>TAHUN 2016 M/ 1438 H</h1>
		</div>
		<div class="row">
		<?php
		$i=0;
		while($kandidat = $result->fetch_array()){
			// $concated_values = $kandidat['no_kandidat'];
			$i++;
		?>
			<div class="col-md-4 text-center <?php if($kandidat['no_kandidat']==1){?>col-md-offset-2<?php } ?>">
			<h4><?php echo $kandidat['no_kandidat']; ?></h4>
				<div class="view view-first">
					<?php
						$no_kandidat = $kandidat['no_kandidat'];
						$query_detail = "SELECT no_urut,no_induk,nama,foto FROM kandidat_detail WHERE no_kandidat={$no_kandidat} order by no_urut";
						$result_detail = $mysqli->query($query_detail);
						
						$concated_values = array();
						while($kandidat_detail = $result_detail->fetch_array()){
							$concated_values[]=$kandidat_detail['no_induk'].';'.$kandidat_detail['nama'];
							$no_urut = $kandidat_detail['no_urut'];
						
					?>
					<img class="<?php echo "no_urut_{$no_urut}" ?>" src="kandidat/<?php echo $kandidat_detail['foto']; ?>" style="width:45%;height:100%" alt="<?php echo $kandidat_detail['foto']; ?>">
					<?php
						}		
					?>
					<div class="mask">
						<input type="hidden" class="no-kandidat" value="<?php echo $no_kandidat; ?>">
						<input type="hidden" class="info-kandidat-1" value="<?php echo $concated_values[0]; ?>">
						<input type="hidden" class="info-kandidat-2" value="<?php echo $concated_values[1]; ?>">
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
			if($i==2)
				break;
		}
		?>
		</div>
		<div class="row">
			
			<?php
		$i=0;
		while($kandidat = $result->fetch_array()){
			// $concated_values = $kandidat['no_kandidat'];
			$i++;
		?>
			<div class="col-md-4 text-center">
			<h4><?php echo $kandidat['no_kandidat']; ?></h4>
				<div class="view view-first">
					<?php
						$no_kandidat = $kandidat['no_kandidat'];
						$query_detail = "SELECT no_urut,no_induk,nama,foto FROM kandidat_detail WHERE no_kandidat=$no_kandidat order by no_urut";
						$result_detail = $mysqli->query($query_detail);
						$concated_values = array();
						while($kandidat_detail = $result_detail->fetch_array()){
							$concated_values[]=$kandidat_detail['no_induk'].';'.$kandidat_detail['nama'];
							$no_urut = $kandidat_detail['no_urut'];
						
					?>
					<img class="<?php echo "no_urut_{$no_urut}" ?>" src="kandidat/<?php echo $kandidat_detail['foto']; ?>" style="width:45%;height:100%" alt="<?php echo $kandidat_detail['foto']; ?>">
					<?php
						}		
					?>
					<div class="mask">
						<!--<h2>Hover Style #1</h2>-->
						<input type="hidden" class="no-kandidat" value="<?php echo $no_kandidat; ?>">
						<input type="hidden" class="info-kandidat-1" value="<?php echo $concated_values[0]; ?>">
						<input type="hidden" class="info-kandidat-2" value="<?php echo $concated_values[1]; ?>">
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
	  <div class="modal-dialog modal-lg">
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
			<div class="row">
				<div class="col-md-6">
					<img class="thumbnail center-block" id="selected-foto-1" src="" style="width:290px">
					<h3><span id="selected-nama-1"></span><br><span id="selected-no-induk-1"></span></h3>
				</div>
				<div class="col-md-6">
					<img class="thumbnail center-block" id="selected-foto-2" src="" style="width:290px">
					<h3><span id="selected-nama-2"></span><br><span id="selected-no-induk-2"></span></h3>
				</div>
			</div>
					
			
			
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
				var imgSrc1 = $(this).parent().siblings().filter('.no_urut_1').attr('src');
				var imgSrc2 = $(this).parent().siblings().filter('.no_urut_2').attr('src');
				
				var details1 = $(this).siblings().filter('.info-kandidat-1').val().split(";");
				var details2 = $(this).siblings().filter('.info-kandidat-2').val().split(";");
				var noUrut = $(this).siblings().filter('.no-kandidat').val();
				
				$('#selected-foto-1').attr('src',imgSrc1);
				$('#selected-foto-2').attr('src',imgSrc2);
				
				$('h1.selected-no-urut').text(noUrut);
				$('input.selected-no-urut').val(noUrut);
				$('#selected-no-induk-1').text(details1[0]);
				$('#selected-nama-1').text(details1[1]);
				$('#selected-no-induk-2').text(details2[0]);
				$('#selected-nama-2').text(details2[1]);
				
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
