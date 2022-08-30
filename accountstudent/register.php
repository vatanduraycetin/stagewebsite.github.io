<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$klas = $_POST['klas'];
	$studentnummer = $_POST['studentnummer'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM student WHERE studentnummer='$studentnummer'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO student (username, klas, studentnummer, password)
					VALUES ('$username', '$klas', '$studentnummer', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wauw! Gebruikersregistratie voltooid.')</script>";
				$username = "";
				$klas = "";
				$studentnummer = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Oeps! Er is iets fout gegaan.')</script>";
			}
		} else {
			echo "<script>alert('Oeps! Dit studentnummer bestaat al.')</script>";
		}
		
	} else {
		echo "<script>alert('Oeps! Wachtwoord komt niet overeen.')</script>";
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

	<title>Aanmelden Student</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Aanmelden Student</p>
			<div class="input-group">
				<input type="text" placeholder="Gebruikersnaam" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Klas" name="klas" value="<?php echo $klas; ?>" required>
			</div>
			<div class="input-group">
				<input type="number" placeholder="Studentnummer" name="studentnummer" value="<?php echo $studentnummer; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Wachtwoord" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Bevestig wachtwoord" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Aanmelden</button>
			</div>
			<p class="login-register-text">Heb je al een account? <a href="index.php">Hier inloggen</a>.</p>
		</form>
	</div>
</body>
</html>