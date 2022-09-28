<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "db_sekolah";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
	// echo "Koneksi Berhasil";
} else {
	die("Koneksi Gagal: " . mysqli_connect_error());
}

?>