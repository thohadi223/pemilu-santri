<?php
	require_once('../config/connection.php');
	
	try{
		$query = "SELECT no_induk,nama,jenis_kelamin,kelas,level,kamar, DATE_FORMAT(tgl_lahir,'%d %b %Y') tgl_lahir,status	 FROM pemilih";
		$hasil = $mysqli->query($query);
		$i=0;
		$response['data'] = array();
		while($pemilih = $hasil->fetch_array()){
			$jeniskelamin = "";
			if($pemilih['jenis_kelamin']==1){
				$jeniskelamin = "Rijal";
			}else if($pemilih['jenis_kelamin']==2){
				$jeniskelamin = "Nisa";
			}
			$status = "";
			if($pemilih['status']==1){
				$status = "Sudah Memilih";
			}else{
				$status = "Belum Memilih";
			}
			if(strlen($pemilih['nama'])>45){
				$nama=substr($pemilih['nama'],0,42).'...';
			}else{
				$nama=$pemilih['nama'];
			}
			$i++;
			$response['data'][] = array($i,$pemilih['no_induk'],$nama,$jeniskelamin,$pemilih['kelas'],$pemilih['level'],$pemilih['kamar'],$pemilih['tgl_lahir'],$status);
		}
		
		
	}catch(Exception $e){
		$response['error']=$e->getMessage();
	}finally{
		echo json_encode($response);
	}
	
	//echo $query;
?>