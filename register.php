<?php
include 'config.php';
session_start();

if ($_SESSION) {
	header('location:admin_home.php');
}

$salah = "";

if (isset($_POST['register'])) {
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmpsw = $_POST['confirmpassword'];

	$query1 = mysqli_query($conn, "SELECT * FROM user WHERE username LIKE '$username'");
	$query2 = mysqli_query($conn, "SELECT * FROM user WHERE email LIKE '$email'");

	if (mysqli_num_rows($query1)) {
		while (mysqli_fetch_array($query1)) {
			echo "<script>alert('Username sudah digunakan');
			document.location='register.php'</script>";
		}
	} else if (mysqli_num_rows($query2)) {
		while (mysqli_fetch_array($query2)) {
			echo "<script>alert('Email sudah digunakan');
			document.location='register.php'</script>";
		}
	} else if ($password != $confirmpsw) {
		$salah = "Password Tidak Sama";
		// echo "<script>alert('Password Tidak Sama');
		// document.location='register.php'</script>";
	} else {
		$query = mysqli_query($conn, "INSERT INTO user (username, password, email) VALUE ('$username', '$password', '$email')");
		echo "<script>alert('Pendaftaran Berhasil');
		document.location='index.php'</script>";
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
			<a class="navbar-brand" href="#">KAMPUSKU</a>
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
			<h4 class="">REGISTER</h4>

			<div class="mb-3">
				<label class="form-label">Email</label>
				<input name="email" type="text" class="form-control" placeholder="Masukkan Email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input name="username" type="text" class="form-control" placeholder="Masukkan Username" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input name="password" type="password" class="form-control" placeholder="Masukkan Password" required>
			</div>
			<div class="mb-1">
				<label class="form-label">Confirm Password</label>
				<input name="confirmpassword" type="password" class="form-control" placeholder="Masukkan Ulang Password" required>

				<?php
				if ($salah) {
				?>
					<div class="text-danger w-50 p-md-2" role="alert">
						<?php echo $salah; ?>
					</div>
				<?php
				}
				?>

			</div>
			<div class="row">
				<div class="text-start col">
					<button type="submit" class="btn btn-sm btn-primary" name="register"> SIGN UP </button>
				</div>
				<div class="text-end col">
					<p>Already have an account? <a href="index.php">Sign in</a></p>
				</div>
			</div>
		</form>
	</div>

</body>

</html>

<script src="asset/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>