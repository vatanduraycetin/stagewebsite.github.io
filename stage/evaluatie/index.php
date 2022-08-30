<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Evaluatie</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Voeg een evaluatie toe</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Cijfer voor de begeleiding</th>
                          <th>Cijfer voor geleerde technieken</th>
                          <th>Algemeen cijfer voor het bedrijf</th>
                          <th>Overige opmerkingen</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM evaluatie ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['begeleiding'] . '</td>';
                                echo '<td>'. $row['technieken'] . '</td>';
                                echo '<td>'. $row['bedrijf'] . '</td>';
                                echo '<td>'. $row['opmerking'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Bekijken</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Updaten</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Verwijderen</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>