<?php
include 'config.php';
session_start();

if ($_SESSION) {
	header('location:admin_home.php');
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = mysqli_query($conn, "SELECT * FROM user JOIN role ON user.id_role = role.id_role WHERE username = '$username' AND password = '$password'");
	$cek = mysqli_num_rows($query);

	if ($cek > 0) {
		$data = mysqli_fetch_assoc($query);
		if ($data['role_name'] == "admin") {
	
			$_SESSION['username'] = $data['username'];
			$_SESSION['role_name'] = "admin";
			header("location:admin_home.php");

		} else if ($data['role_name'] == "user") {
	
			$_SESSION['username'] = $data['username'];
			$_SESSION['role_name'] = "user";
	
			header("location:user.php");
		} else {
	
			header("location:index.php?pesan=gagal");
		}
	} else {
		header("location:index.php?pesan=gagal");
	}
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>

	<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">LOGIN</a>
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
				<!-- <form class="d-flex ms-auto"role="search"> -->
				<!-- <input class="form-control me-2" type="search" name="cari" placeholder="Search" aria-label="Search"> -->
				<!-- <a class="btn btn-outline-success" type="submit">Logout</a>
				</form> -->
			</div>
		</div>
	</nav>

	<!-- FORM -->
	<div class="container mt-5">
		<form action="" method="post" class="border rounded-3 bg-light p-4 w-50 mx-auto">
			<h4 class="">KAMPUSKU</h4>
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input name="username" type="text" class="form-control" placeholder="Masukkan Username" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input name="password" type="password" class="form-control" placeholder="Masukkan Password" required>
			</div>
			<div class="mb-3">
				<label class="text-end">don't have an account? </label>
				<a href="register.php">Register here</a>
			</div>
			<div class="text-start">
				<button type="submit" class="btn btn-sm btn-primary" name="login"> LOGIN </button>
			</div>
		</form>
	</div>

</body>

</html>

<script src="asset/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>