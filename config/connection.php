<?php
	$mysqli = new mysqli("127.0.0.1", "root", "", "pemilu");

	if (mysqli_connect_errno()) {
		printf("Koneksi ke database gagal!: %s\n", mysqli_connect_error());
    exit();
}
?>