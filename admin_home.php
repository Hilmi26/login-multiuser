<?php
session_start();
// error_reporting(0);
include 'config.php';

if (isset($_POST['logout'])) {
	session_destroy();
	header('location: index.php');
}


if (!$_SESSION) {
	header('location:index.php');
}

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
				<form action="" method="post" class="d-flex ms-auto" role="search" >
					<!-- <input class="form-control me-2" type="search" name="cari" placeholder="Search" aria-label="Search"> -->
					<button class="btn btn-light" type="submit" name="logout">Logout</button>
				</form>
			</div>
		</div>
	</nav>

	<!-- Tabel -->
	<div class="container mt-5">
		<div class="row">
			<div class="col">
				<a href="create.php" class="btn btn-success ">TAMBAH DATA</a>
			</div>
			<div class="col">
				<form class="d-flex" role="search" method="POST" action="">
					<input class="form-control me-2" type="text" name="search" placeholder="Masukkan Keyword Pencarian">
					<input class="btn btn-info text-light" type="submit" name="cari" value="CARI"></input>
					<a href="index.php" class="btn btn-warning text-light ms-2">Refresh</a>
				</form>
			</div>
		</div>

		<table class="table table-striped mt-3">
			<thead>
				<tr class="text-center">
					<th scope="col">ID</th>
					<th scope="col">NAMA</th>
					<th scope="col">TGL LAHIR</th>
					<th scope="col">NIM</th>
					<th scope="col">JURUSAN</th>
					<th scope="col">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//Pencarian
				if (isset($_POST['search'])) {
					$search = $_POST['search'];
					$mahasiswa = mysqli_query($conn, "SELECT mahasiswa.id_mhs,
					mahasiswa.nama_mhs, mahasiswa.tgl_lahir, mahasiswa.nim, jurusan.nama_jurusan FROM mahasiswa JOIN jurusan
					ON mahasiswa.id_jurusan = jurusan.id_jurusan WHERE mahasiswa.nama_mhs LIKE '%$search%'
					OR mahasiswa.nim LIKE '%$search%' OR jurusan.nama_jurusan LIKE '%$search%'");
				} else {
					//Tampil Semua Data
					$mahasiswa = mysqli_query($conn, "SELECT mahasiswa.id_mhs,
					mahasiswa.nama_mhs, mahasiswa.tgl_lahir, mahasiswa.nim, jurusan.nama_jurusan FROM mahasiswa JOIN jurusan
					ON mahasiswa.id_jurusan = jurusan.id_jurusan");
				}

				if (mysqli_num_rows($mahasiswa)) {

					while ($data = mysqli_fetch_array($mahasiswa)) {
				?>
						<tr class="text-center">
							<td><?php echo $data['id_mhs'] ?></td>
							<td><?php echo $data['nama_mhs'] ?></td>
							<td><?php echo $data['tgl_lahir'] ?></td>
							<td><?php echo $data['nim'] ?></td>
							<td><?php echo $data['nama_jurusan'] ?></td>
							<td>
								<a href="update.php?update=<?php echo $data['id_mhs'] ?>" class="btn btn-sm btn-primary">EDIT</a>
								<a href="?delete=<?php echo $data['id_mhs'] ?>" onclick="return confirm ('Yakin akan menghapus data?')" class="btn btn-sm btn-danger">HAPUS
								</a>
							</td>
						</tr>
				<?php
					}
				} else {
					echo '<tr><td colspan="6" class="text-center">Tidak ada data yang ditemukan</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>


	<!-- Delete -->
	<?php
	if (isset($_GET['delete'])) {
		$query2 = mysqli_query($conn, "DELETE FROM mahasiswa WHERE id_mhs = '$_GET[delete]'");
		echo "<script>alert('Data telah dihapus');
		document.location='index.php'</script>";
	}
	?>

</body>

</html>

<script src="asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>