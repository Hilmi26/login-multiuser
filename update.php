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

	<!-- Form UPDATE -->

	<?php 
	
	$query_update = mysqli_query($conn, "SELECT * FROM mahasiswa, jurusan
	WHERE mahasiswa.id_jurusan = jurusan.id_jurusan and mahasiswa.id_mhs='$_GET[update]'"); //mahasiswa.id_mhs='$_GET[update] = mengambil id yg diklik
	$data = mysqli_fetch_array($query_update);

	?>

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
						<td><input type="text" class="form-control" name="nama" value="<?php echo $data['nama_mhs'] ?>"></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td><input type="date" class="form-control" name="tgl_lahir" value="<?php echo $data['tgl_lahir'] ?>"></td>
					</tr>
					<tr>
						<td>NIM</td>
						<td><input type="number" class="form-control" name="nim" value="<?php echo $data['nim'] ?>"></td>
					</tr>
					<tr>
						<td>JURUSAN</td>
						<div class="input-group">
							<td>
								<select name="id_jurusan" class="custom-select container-fluid form-control">
									<?php
									echo "<option value=$data[id_jurusan]> $data[nama_jurusan]</option>";
									$query1 = mysqli_query($conn, "SELECT * FROM jurusan");
									while ($data2 = mysqli_fetch_array($query1)) {
										echo "<option value=$data2[id_jurusan]> $data2[nama_jurusan]</option>";
										
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
			<button type="submit" class="btn btn-primary" name="submit">Update</button>
			</div>
		</form>
	</div>

</body>   

</html>

<script src="asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>

<?php

if (isset($_POST['submit'])) {
	mysqli_query($conn, "UPDATE mahasiswa set 
	nama_mhs = '$_POST[nama]', 
	tgl_lahir = '$_POST[tgl_lahir]',
	nim = '$_POST[nim]',
	id_jurusan = '$_POST[id_jurusan]'
	WHERE id_mhs = $_GET[update];");
	
	echo"<script>alert('Data telah diubah');
	document.location='index.php'</script>";
}

//nama_mhs kiri adalah nama kolom di mysql
//nama kanan adalah nama atribut input pada formnya

?>

