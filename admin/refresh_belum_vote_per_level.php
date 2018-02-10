<?php
	require_once('../config/connection.php');
	
	try{
		$response = array();
		$query = "SELECT level,COUNT(1) jumlah FROM pemilih where status = 0 group by level";
		$hasil = $mysqli->query($query);
		
		while($row = $hasil->fetch_array()){
			$response[$row['level']] = $row['jumlah'];
		}
		
		
	}catch(Exception $e){
		$response['error']=$e->getMessage();
	}finally{
		echo json_encode($response);
	}
	
	//echo $query;
?>