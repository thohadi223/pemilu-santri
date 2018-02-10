<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('location:login.php');
	
	require_once('../config/connection.php');
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
	<link rel="stylesheet" href="bootstrap-switch/build/css/bootstrap3/bootstrap-switch.min.css">
	
    <!-- Custom styles for this template -->
    <link href="css/admin.css" rel="stylesheet">
	<link rel="stylesheet" media="screen" href="datatables/css/dataTables.bootstrap.min.css">
	

  </head>

  <body>
	
	<nav class="left-menu">
		<ul class="nav nav-pills">
			<li role="presentation" class="active"><a href="index.php" title="Progress">Progress</a></li>
			<li role="presentation"><a href="result.php" title="Result">Result</a></li>
		</ul>
	</nav>
	

    <div class="container">
		<h1 class="text-center">Pemilihan Presiden OPAZ</h1>
		<div class="page-header bootstrap-admin-content-title">
		<div class="pull-right"><input type="checkbox" id="toggle-refresh" name="toggle-refresh" checked value="1"> Auto-refresh</div>
			<h2>Progress Pemilihan</h2>
			
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="bootstrap-admin-box-title">Progress Penggunaan Hak Suara</div>
						
					</div>
					<div class="bootstrap-admin-panel-content">
						<div class="progress">
							<div class="progress-bar progress-bar-striped active bar" style="width: 0%;"></div>
						</div>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-5">Total Pemilih</label>
								<?php
									$select_count_pemilih = "select count(1) from pemilih";
									$result_count_pemilih = $mysqli->query($select_count_pemilih);
									$count_pemilih = $result_count_pemilih->fetch_array();
								?>
								<p class="col-md-5 form-control-static" ><?php echo number_format($count_pemilih[0]); ?></p>
								<input type="hidden" id="total-pemilih" value="<?php echo $count_pemilih[0]; ?>">
							</div>
							<div class="form-group">
								<label class="control-label col-md-5">Sudah Memilih</label>
								<p class="col-md-5 form-control-static" id="sudah-memilih">0</p>
							</div>
							<div class="form-group">
								<label class="control-label col-md-5">Belum Memilih</label>
								<p class="col-md-5 form-control-static" id="belum-memilih">0</p>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="bootstrap-admin-box-title">Data Pemilih Belum Menggunakan Hak Suara</div>
						
					</div>
					<div class="bootstrap-admin-panel-content">
						<div class="row">
							<div class="col-md-4 text-center">
								<h2><span id="unvoted-7">-</span><br>
								<small>Kelas 7</small>
								<h2>
							</div>
							<div class="col-md-4 text-center">
								<h2><span id="unvoted-8">-</span><br>
								<small>Kelas 8</small>
								<h2>
							</div>
							<div class="col-md-4 text-center">
								<h2><span id="unvoted-9">-</span><br>
								<small>Kelas 9</small>
								<h2>
							</div>
							
							
						</div>
						<div class="row">
							<div class="col-md-4 text-center">
								<h2><span id="unvoted-10">-</span><br>
								<small>Kelas 10</small>
								<h2>
							</div>
							<div class="col-md-4 text-center">
								<h2><span id="unvoted-11">-</span><br>
								<small>Kelas 11</small>
								<h2>
							</div>
							<div class="col-md-4 text-center">
								<h2><span id="unvoted-12">-</span><br>
								<small>Kelas 12</small>
								<h2>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="bootstrap-admin-box-title">Data Pemilih</div>
				</div>
				<div class="bootstrap-admin-panel-content" style="font-size:.9em">
				<?php
					$query = "SELECT * FROM pemilih";
					$result_pemilih = $mysqli->query($query);
					
				?>
				<div style="padding:10px;">
					<table class="table table-striped table-bordered" id="data-pemilih">
						<thead>
							<tr>
								<th>#</th>
								<th>No. Induk</th>
								<th>Nama</th>
								<th>Gender</th>
								
								<th>Kelas</th>
								<th>Level</th>
								<th>Kamar</th>
								<th>Tgl. Lahir</th>
								<th>Status</th>
							</tr>
							
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>No. Induk</th>
								<th>Nama</th>
								<th>Gender</th>
								
								<th>Kelas</th>
								<th>Level</th>
								<th>Kamar</th>
								<th>Tgl. Lahir</th>
								<th>Status</th>
							</tr>
							
						</tfoot>
					</table>
					</div>
				</div>
			</div>
			
		</div>
    </div><!-- /.container -->


    <?php include('js.html'); ?>
	<script type="text/javascript" src="bootstrap-switch/build/js/bootstrap-switch.min.js"></script>
		<script type="text/javascript" src="datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="datatables/js/dataTables.bootstrap.min.js"></script>
	<script>
		$(function(){
			refreshPenggunaanSuara();
			var autoRefresh = setInterval(refreshPenggunaanSuara,10000);
			$('#toggle-refresh').bootstrapSwitch();
			$('#toggle-refresh').on('switch-change',function(){
				
				if($('#toggle-refresh').is(':checked')){
					clearInterval(autoRefresh);
				}else{
					refreshPenggunaanSuara();
					autoRefresh = setInterval(refreshPenggunaanSuara,10000);
				}
			});
			
			var datatable = $('#data-pemilih').DataTable({
				"dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'<'btn-refresh'>><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
				ajax:'load_pemilih.php',
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select><option value=""></option></select>')
							.appendTo( $(column.footer()).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);
		 
								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
							} );
		 
						column.data().unique().sort().each( function ( d, j ) {
							
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					});
				}
			} );

			$('.btn-refresh').html('<button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>');
			$('.btn-refresh').bind('click',function(){
				datatable.ajax.reload();
			})
			function refreshPenggunaanSuara(){
				var totalPemilih = parseInt($('#total-pemilih').val());
				
				var sudahMemilih =0;
				var belumMemilih =0;
				
				var progressBarWidth= $('.progress').width();
				
				$.get('refresh_penggunaan_suara.php',
					function(json,status){
						if(json['error']==null){
							sudahMemilih=parseInt(json['sudah_pilih']);
							belumMemilih=parseInt(json['belum_pilih']);
							
							$('#sudah-memilih').text(sudahMemilih.toLocaleString());
							$('#belum-memilih').text(belumMemilih.toLocaleString());
							
							var percentage = parseFloat(sudahMemilih)/totalPemilih;
							
							$('.bar').width(percentage*progressBarWidth);
							// $('.bar').width(50);
							$('.bar').text((percentage*100).toFixed(2)+'%');
						}else{
							
							$('#sudah-memilih,#belum-memilih').text(json['error']);
						}
							
					},'json');
				$.get('refresh_belum_vote_per_level.php',
					function(json,status){
						if(json['error']==null){
							$('#unvoted-7').text(json['7']);
							$('#unvoted-8').text(json['8']);
							$('#unvoted-9').text(json['9']);
							$('#unvoted-10').text(json['10']);
							$('#unvoted-11').text(json['11']);
							$('#unvoted-12').text(json['12']);
						}else{
							
							$('#total-penggunaan').text(json['error']);
						}
							
					},'json');
			}
			
		});
	</script>
  </body>
</html>
