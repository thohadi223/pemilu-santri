<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('location:login.php');
	
	require_once('../config/connection.php');
	$settings = include('../config/settings.php');
	$query = "SELECT no_kandidat,nama,ifnull(perolehan_suara,0) perolehan_suara FROM kandidat A 
	LEFT JOIN (SELECT kandidat,count(1) perolehan_suara FROM suara_pemilih GROUP BY kandidat) B ON A.no_kandidat = B.kandidat 
    GROUP BY no_kandidat,nama order by no_kandidat asc";
	$result = $mysqli->query($query);
	
	$query_chart = "SELECT  no_kandidat,nama,IFNULL(perolehan_suara, 0) perolehan_suara FROM kandidat A
        LEFT JOIN (SELECT kandidat, COUNT(1) perolehan_suara FROM suara_pemilih GROUP BY kandidat) B ON A.no_kandidat = B.kandidat 
	GROUP BY no_kandidat , nama ORDER BY no_kandidat";
	
	$result_chart = $mysqli->query($query_chart);
	
	$query_by_suara = "SELECT no_kandidat, nama,ifnull(perolehan_suara,0) perolehan_suara FROM kandidat A 
LEFT JOIN (SELECT kandidat,count(1) perolehan_suara FROM suara_pemilih GROUP BY kandidat) B ON A.no_kandidat= B.kandidat 
GROUP BY no_kandidat,nama order by B.perolehan_suara desc,no_kandidat asc";
	$result_by_suara = $mysqli->query($query_by_suara);
	
	
	
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
	
	
    <!-- Custom styles for this template -->
    <link href="css/admin.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	
	
	<style>
		.mask{
			opacity: 1;
			background-color: rgba(219,127,8, 0.7);
			font-weight:bold;
			font-size: 15px;
		}
		img {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			transform: rotate(0deg);
		}
	</style>
  </head>

  <body>
	
	<div id="header" style="min-height:100px;">
		<nav class="left-menu">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="index.php" title="Progress">Progress</a></li>
				<li role="presentation"  class="active"><a href="result.php" title="Result">Result</a></li>
			</ul>
		</nav>
		<div class="text-center fix-header">
		
			<h2 style="font-size:22px;line-height:30px">HASIL AKHIR PEROLEHAN SUARA<br>PEMILIHAN PRESIDEN ORGANISASI PELAJAR AL-ZAYTUN
			<br><?php echo $settings['tahun_pemilihan'] ?></h2>
		</div>
	</div>
	
    <div class="container">

		<h3 class="text-center">Perolehan Suara Per Kandidat</h3>
		<div id="single-kandidat-show" class="row" style="height:650px">
			<div class="col-md-6">
				<ul id="single-kandidat">
					
						<?php
						$i=11;
						while($kandidat = $result->fetch_array()){
							
							$i--;
						?><li class="kandidat-holder" style="z-index:<?php echo $i; ?>;opacity:0">
							<input type="hidden" class="perolehan-suara" value="<?php echo $kandidat['perolehan_suara']; ?>">
							<div class="text-center bg-warning" style="padding-bottom:10px">
								<h1><?php echo $kandidat['no_kandidat']; ?></h1>
								
								<div class="center-block view view-first" style="width:75%">
									<?php
										$no_kandidat = $kandidat['no_kandidat'];
										$query_detail = "SELECT no_urut,no_induk,nama,foto FROM kandidat_detail WHERE no_kandidat=$no_kandidat order by no_urut";
										$result_detail = $mysqli->query($query_detail);
										
										while($kandidat_detail = $result_detail->fetch_array()){
											$concated_values[]=$kandidat_detail['no_induk'].';'.$kandidat_detail['nama'];
											$no_urut = $kandidat_detail['no_urut'];
										
									?>
									<img src="../kandidat/<?php echo $kandidat_detail['foto']; ?>" style="width:45%;" alt="<?php echo $kandidat_detail['foto']; ?>">
									<?php
										}		
									?>
									
									
								</div>
								<h2><?php echo $kandidat['nama']; ?></h2>
							</div>
							</li>
						<?php
						}
						?>
					
				</ul>
				
			</div>
			<div class="col-md-6">
				<h1 class="text-center" style="margin-top:80px">JUMLAH SUARA</h1> 
				<h1 class="text-center counter bg-primary">0</h1>
			</div>
		</div>
		<div id="chart-show" style="padding-top:50px;">
			<div id="chart" style="min-width: 310px; height: 700px; margin:0px auto"></div>
			<table id="table-perolehan-suara" class="hidden">
			<thead>
				<tr>
					<th></th>
					<th>Jumlah Suara</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//$result_chart->data_seek(0);
					while($kandidat = $result_chart->fetch_array()){
				?>
				<tr>
					<th><?php echo $kandidat['nama']; ?></th>
					<td><?php echo $kandidat['perolehan_suara']; ?></td>
				</tr>
					<?php } ?>
			</tbody>
			</table>
		</div>
		<div id="final-result" style="margin-top:30px;">
			<div class="text-center fix-header" style="margin-bottom:20px;">
		
				<h2 style="font-size:22px;line-height:30px;padding:15px 0px;">HASIL AKHIR PEROLEHAN SUARA<br>PEMILIHAN PRESIDEN ORGANISASI PELAJAR AL-ZAYTUN
				<br><?php echo $settings['tahun_pemilihan'] ?></h2>
			</div>
			<div class="row">
				<?php
					$kandidat = $result_by_suara->fetch_array();
						
				?>
				<div class="col-md-6 col-md-offset-3" style="padding-right:2px;padding-left:2px;">
					<div class="text-center bg-success" style="padding-bottom:10px">
						<h3 class="bg-warning" style="margin-bottom:10px;padding:10px">Presiden &amp; Wakil Presiden</h3>
						<div class="center-block view view-first" style="width:75%">
							<?php
								$no_kandidat = $kandidat['no_kandidat'];
								$query_detail = "SELECT no_urut,no_induk,nama,foto FROM kandidat_detail WHERE no_kandidat=$no_kandidat order by no_urut";
								$result_detail = $mysqli->query($query_detail);
								
								while($kandidat_detail = $result_detail->fetch_array()){
								
							?>
							<img src="../kandidat/<?php echo $kandidat_detail['foto']; ?>" style="width:45%;" alt="<?php echo $kandidat_detail['foto']; ?>">
							<?php
								}		
							?>
							
							<div class="mask bg-danger">
								<!--<h2>Hover Style #1</h2>-->
								
								<a href="javascript:void(0)" class="info">
									<?php echo $kandidat['perolehan_suara'];?> SUARA
								</a>
							</div>
						</div>
						<h3><?php echo $kandidat['nama']; ?></h3>
					</div>
				</div>
				
				
			</div>
			<div class="row">
				
					<?php
					$i=1;
					while($kandidat = $result_by_suara->fetch_array()){
						$i++;
					?>
					<div class="col-md-3" style="padding-right:2px;padding-left:2px;">
						<div class="text-center" style="padding-bottom:10px">
							<p><strong><?php echo $i; ?></strong></p>
							
							<div class="view view-first">
								
								<?php
								$no_kandidat = $kandidat['no_kandidat'];
								$query_detail = "SELECT no_urut,no_induk,nama,foto FROM kandidat_detail WHERE no_kandidat=$no_kandidat order by no_urut";
								$result_detail = $mysqli->query($query_detail);
								
								while($kandidat_detail = $result_detail->fetch_array()){
								
							?>
							<img src="../kandidat/<?php echo $kandidat_detail['foto']; ?>" style="width:45%;" alt="<?php echo $kandidat_detail['foto']; ?>">
							<?php
								}		
							?>
								<div class="mask">
									<!--<h2>Hover Style #1</h2>-->
									
									
									<a href="javascript:void(0)" class="info">
										<?php echo $kandidat['perolehan_suara'];?> SUARA
									</a>
								</div>
							</div>
							<p><?php echo $kandidat['nama']; ?></p>
						</div>
					</div>
					<?php } ?>
				
				
				
				
				
			</div>
		</div>
		
    </div><!-- /.container -->
	
	
	<?php include('js.html'); ?>
	<script src="scrollto/jquery-scrollto.js"></script>
	<script src="highcharts/highcharts.js"></script>
	<script src="highcharts/modules/data.js"></script>
	<script src="highcharts/modules/exporting.js"></script>
	<script>
		$(function(){
			
			//$('.kandidat-holder').eq(0).css('opacity','1');
			var i =0;
			var $holders = $('.kandidat-holder');
			$('body').keypress(function(e){
				
				if(e.keyCode==110){
					if(i<10){
						if(i>0){
							$holders.eq(i-1).animate({left:-250,opacity:0 },500);
						}
						$('.counter').stop();
						$holders.eq(i).animate({opacity:1}, 500);
						var suara = $holders.eq(i).children().filter('.perolehan-suara').val();
						$('.counter').text(0);
						
						$('.counter').delay(400);
						
						$('.counter').prop('Counter',0).animate({
							Counter: suara
						}, {
							duration: 10000,
							easing: 'swing',
							step: function (now) {
								$('.counter').text(Math.ceil(now));
							}
						});
						i++;
					}
					
					
				}else if(e.keyCode==98){
					
					if(i>1){
						i--;
						if(i<10){
							$holders.eq(i-1).animate({left:0,opacity:1 },500);
							var suara = $holders.eq(i-1).children().filter('.perolehan-suara').val();
							$('.counter').text(0);
							
							$('.counter').delay(400);
							
							$('.counter').prop('Counter',0).animate({
								Counter: suara
							}, {
								duration: 4000,
								easing: 'swing',
								step: function (now) {
									$('.counter').text(Math.ceil(now));
								}
							});
							$('.counter').stop();
							$holders.eq(i).animate({opacity:0}, 500);
						}
						
						
						
					}
				}else if(e.keyCode==49){
					$("#header").ScrollTo();
				}else if(e.keyCode==50){
					$("#chart-show").ScrollTo({
						duration: 500,
						callback: function(){
							$('#chart').highcharts({
							data: {
								table: 'table-perolehan-suara'
							},
							chart: {
								type: 'column'
							},
							title: {
								text: 'STATISTIK PEROLEHAN SUARA',
								style: {fontSize: '20px',fontWeight:'bold'}
							},
							xAxis: {
								type: 'category',
								labels: {
									autoRotationLimit: 40,
									style: {
										fontSize: '14px',
										fontFamily: 'Verdana, sans-serif'
									}
								}
							},
							plotOptions: {
								column: {
									dataLabels: {
										enabled: true,
										style: {
											"fontSize": "16px"
										}
										
									}
								}
							},
							yAxis: {
								allowDecimals: false,
								title: {
									text: 'Perolehan Suara'
								}
							},
							tooltip: {
								formatter: function () {
									return '<b>' + this.series.name + '</b><br/>' +
										this.point.y + ' ' + this.point.name.toLowerCase();
								}
							}
						});
						}
					});
				}else if(e.keyCode==51){
					$("#final-result").ScrollTo({duration: 500});
				}
			});
			
		});
	
	</script>
  </body>
</html>
