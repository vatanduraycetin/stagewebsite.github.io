<?php
    require 'database.php';
 
    if ( isset($_POST['submit'])) {
        // keep track validation errors
        $id = null;
        $begeleidingError = null;
        $techniekenError = null;
        $bedrijfError = null;
        $opmerkingError = null;
        
         
        // keep track post values
        $id = $_POST['id'];
        $begeleiding = $_POST['begeleiding'];
        $technieken = $_POST['technieken'];
        $bedrijf = $_POST['bedrijf'];
        $opmerking = $_POST['opmerking'];
        
         
        // validate input
        $valid = true;
        if (empty($begeleiding)) {
            $begeleidingError = 'Typ hier je cijfer voor de begeleiding';
            $valid = false;
        }
         
        if (empty($technieken)) {
            $techniekenError = 'Typ hier je cijfer voor geleerde technieken';
            $valid = false;
        } 
         
        if (empty($bedrijf)) {
            $bedrijfError = 'Typ hier je cijfer voor het bedrijf';
            $valid = false;
        }

         if (empty($opmerking)) {
            $opmerkingError = 'Typ hier je opmerkingen';
            $valid = false;
        }

        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE evaluatie set begeleiding = ?, technieken = ?, bedrijf = ?, opmerking = ?, WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($begeleiding,$technieken,$bedrijf,$opmerking,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $id = $_GET['id'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM evaluatie where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $begeleiding = $data['begeleiding'];
        $technieken = $data['technieken'];
        $bedrijf = $data['bedrijf'];
        $opmerking = $data['opmerking'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Updaten</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php" method="post">
                         <div class="control-group <?php echo !empty($begeleidingError)?'error':'';?>">
                        <label class="control-label">Begeleiding</label>
                        <div class="controls">
                            <input name="begeleiding" type="number"  placeholder="Cijfer" value="<?php echo !empty($begeleiding)?$begeleiding:'';?>">
                            <?php if (!empty($begeleidingError)): ?>
                                <span class="help-inline"><?php echo $begeleidingError;?></span>
                            <?php endif;?>
                        </div>
                      <div class="control-group <?php echo !empty($techniekenError)?'error':'';?>">
                        <label class="control-label">Technieken</label>
                        <div class="controls">
                            <input name="technieken" type="number" placeholder="Cijfer" value="<?php echo !empty($technieken)?$technieken:'';?>">
                            <?php if (!empty($techniekenError)): ?>
                                <span class="help-inline"><?php echo $techniekenError;?></span>
                            <?php endif;?>
                        </div>
                      <div class="control-group <?php echo !empty($bedrijfError)?'error':'';?>">
                        <label class="control-label">Het bedrijf</label>
                        <div class="controls">
                            <input name="bedrijf" type="number"  placeholder="Cijfer" value="<?php echo !empty($bedrijf)?$bedrijf:'';?>">
                            <?php if (!empty($bedrijfError)): ?>
                                <span class="help-inline"><?php echo $bedrijfError;?></span>
                            <?php endif;?>
                        </div>
                        <div class="control-group <?php echo !empty($opmerkingError)?'error':'';?>">
                       <label class="control-label">Overige opmerkingen</label>
                       <div class="controls">
                            <input name="opmerking" type="text"  placeholder="Opmerking" value="<?php echo !empty($opmerking)?$opmerking:'';?>">
                            <?php if (!empty($opmerkingError)): ?>
                                <span class="help-inline"><?php echo $opmerkingError;?></span>
                            <?php endif;?>
                        </div>
                      <div class="form-actions">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                          <input name="submit" value="Opslaan" type="submit" class="btn btn-success">
                          <a class="btn" href="index.php">Terug</a>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>