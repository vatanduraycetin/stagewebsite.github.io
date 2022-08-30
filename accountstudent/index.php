<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$studentnummer = $_POST['studentnummer'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM student WHERE studentnummer='$studentnummer' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Oeps! Studentnummer of wachtwoord is verkeerd.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Inloggen Student</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Inloggen Student</p>
			<div class="input-group">
				<input type="number" placeholder="Studentnummer" name="studentnummer" value="<?php echo $studentnummer; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Wachtwoord" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Inloggen</button>
			</div>
			<p class="login-register-text">Heb je nog geen account? <a href="register.php">Registreer hier</a>.</p>
		</form>
	</div>
</body>
</html>