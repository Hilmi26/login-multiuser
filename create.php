<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="asset/bootstrap/custom/style.css">
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="admin_home.php">Kampusku</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Dropdown
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">Something else here</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled">Disabled</a>
					</li>
				</ul> -->
				<form class="d-flex ms-auto"role="search">
					<!-- <input class="form-control me-2" type="search" name="cari" placeholder="Search" aria-label="Search"> -->
					<a class="btn btn-outline-success" type="submit">Logout</a>
				</form>
			</div>
		</div>
	</nav>

	<!-- Form CRUD -->
	<div class="container mt-5">
		<form action="" method="post">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">BIODATA MAHASISWA</th>
					</tr>
				</thead>
				<tbody>
				<tr>
						<td>Nama</td>
						<td><input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td><input type="date" class="form-control" name="tgl_lahir"></td>
					</tr>
					<tr>
						<td>NIM</td>
						<td><input type="number" class="form-control" name="nim" placeholder="Masukkan NIM" required></td>
					</tr>
					<tr>
						<td>JURUSAN</td>
						<div class="input-group">
							<td>
								<select name="id_jurusan" class="custom-select container-fluid form-control">
									<option selected>Pilih Jurusan</option>
									<?php
									$sql = mysqli_query($conn, "SELECT * FROM jurusan");
									while ($data1 = mysqli_fetch_array($sql)) {
										echo "<option value=$data1[id_jurusan]> $data1[nama_jurusan]</option>"; 
										//value=$data1[id_jurusan] id jurusan yang akan di simpan di tabel mahasiswa
										//$data1[nama_jurusan] label data dari tabel jurusan
										
									}
									?>
								</select>

							</td>
						</div>
					</tr>
				</tbody>
			</table>
			<div class="text-end">
			<a href="index.php" type="button" class="btn btn-danger">Kembali</a>
			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</div>
		</form>
	</div>

</body>

</html>

<script src="asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>

<?php

if (isset($_POST['submit'])) {
	$nama = $_POST['nama'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$nim = $_POST['nim'];
	$jurusan = $_POST['id_jurusan'];

	$query_insert = mysqli_query($conn, "INSERT INTO mahasiswa
	(nama_mhs, tgl_lahir, nim, id_jurusan) VALUES ('$nama', '$tgl_lahir', '$nim', '$jurusan')");

	echo"<script>alert('Data telah tersimpan');
	document.location='index.php'</script>";
}

?>

