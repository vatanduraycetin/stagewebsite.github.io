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
                <h3>Stages</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Voeg een stage toe</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Naambedrijf</th>
                          <th>Plaats</th>
                          <th>Begindatum</th>
                          <th>Website</th>
                          <th>Contactpersoon</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM stageinfo ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['naambedrijf'] . '</td>';
                                echo '<td>'. $row['plaats'] . '</td>';
                                echo '<td>'. $row['begindatum'] . '</td>';
                                echo '<td>'. $row['website'] . '</td>';
                                echo '<td>'. $row['contactpersoon'] . '</td>';
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