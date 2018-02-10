<?php
	require_once('config/connection.php');
	
	$kode = $_POST['kodePemilih'];
	$password = $_POST['passwordPemilih'];
	
	$query = "SELECT COUNT(1) FROM suara_pemilih WHERE kode_pilih = '$kode'";
	$hasil = $mysqli->query($query);
	$row = $hasil->fetch_array();
	
	if($row[0]==0){
		$query = "SELECT no_induk,nama,kelas,date_format(tgl_lahir,'%d%m%Y') password_pemilih FROM pemilih WHERE no_induk = '$kode'";
		$hasil = $mysqli->query($query);
		$response = array();
		
		if($hasil){
			if($hasil->num_rows>0){
				// while($row = mysqli_fetch_array($hasil)){
					// $response[] = $row;
				// }
				$response = $hasil->fetch_assoc();
				if($response['password_pemilih']!=$password){
					$response['error']='Password salah.';
				}
			}else{
				$response['error']='No. Induk tidak ditemukan. Silakan hubungi petugas.';
			}
		}else
			$response['error']=$mysqli->error;
	}else{
		$response['error']='No. Induk ini sudah digunakan sebelumnya';
	}
	
	
	
	echo json_encode($response);
	//echo $query;
?>