<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="welcome.css">
    <title>Welkom</title>
</head>
<body>
    <?php echo "<h1>Welkom " . $_SESSION['username'] . "</h1>"; ?>
    <form action="../stage/index.php">
    <input type="submit" value="Klik hier om naar de stages te gaan" />
</form>
    <form action="logout.php">
    <input type="submit" value="Uitloggen" />
</form>
</body>
</html>