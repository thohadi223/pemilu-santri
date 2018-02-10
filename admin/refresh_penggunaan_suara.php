<?php
	require_once('../config/connection.php');
	
	try{
		$query = "SELECT SUM(sudah_pilih) sudah_pilih, SUM(belum_pilih) belum_pilih , SUM(total) total
FROM (
	SELECT Case status when 1 then 1 else 0 end sudah_pilih,
    case status when 0 then 1 else 0 end belum_pilih , 1 total FROM pemilih
) data_pemilih";
		$hasil = $mysqli->query($query);
		$row = $hasil->fetch_array();
		
		$response['total'] = $row['total'];
		$response['belum_pilih'] = $row['belum_pilih'];
		$response['sudah_pilih'] = $row['sudah_pilih'];
		
	}catch(Exception $e){
		$response['error']=$e->getMessage();
	}finally{
		echo json_encode($response);
	}
	
	//echo $query;
?>