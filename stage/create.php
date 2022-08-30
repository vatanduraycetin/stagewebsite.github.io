<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $naambedrijfError = null;
        $plaatsError = null;
        $begindatumError = null;
        $websiteError = null;
        $contactpersoonError = null;
         
        // keep track post values
        $naambedrijf = $_POST['naambedrijf'];
        $plaats = $_POST['plaats'];
        $begindatum = $_POST['begindatum'];
        $website = $_POST['website'];
        $contactpersoon = $_POST['contactpersoon'];
         
        // validate input
        $valid = true;
        if (empty($naambedrijf)) {
            $naambedrijfError = 'Typ hier je naam van het bedrijf';
            $valid = false;
        }
         
        if (empty($plaats)) {
            $plaatsError = 'Typ hier de plaats van het bedrijf';
            $valid = false;
        } 
         
        if (empty($begindatum)) {
            $begindatumError = 'Typ hier de begindatum van het bedrijf';
            $valid = false;
        }

         if (empty($website)) {
            $websiteError = 'Voeg hier de website link van het bedrijf';
            $valid = false;
        }

         if (empty($contactpersoon)) {
            $contactpersoonError = 'Typ hier de naam van de contactpersoon';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO stageinfo (naambedrijf,plaats,begindatum,website,contactpersoon) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($naambedrijf,$plaats,$begindatum,$website,$contactpersoon));
            Database::disconnect();
            header("Location: index.php");
        }
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
                        <h3>Voeg een stage toe</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                         <div class="control-group <?php echo !empty($naambedrijfError)?'error':'';?>">
                        <label class="control-label">Naambedrijf</label>
                        <div class="controls">
                            <input name="naambedrijf" type="text"  placeholder="Naambedrijf" value="<?php echo !empty($naambedrijf)?$naambedrijf:'';?>">
                            <?php if (!empty($naambedrijfError)): ?>
                                <span class="help-inline"><?php echo $naambedrijfError;?></span>
                            <?php endif;?>
                        </div>
                      <div class="control-group <?php echo !empty($plaatsError)?'error':'';?>">
                        <label class="control-label">Plaats</label>
                        <div class="controls">
                            <input name="plaats" type="text" placeholder="Plaats" value="<?php echo !empty($plaats)?$plaats:'';?>">
                            <?php if (!empty($plaatsError)): ?>
                                <span class="help-inline"><?php echo $plaatsError;?></span>
                            <?php endif;?>
                        </div>
                      <div class="control-group <?php echo !empty($begindatumError)?'error':'';?>">
                        <label class="control-label">Begindatum</label>
                        <div class="controls">
                            <input name="begindatum" type="date"  placeholder="Begindatum" value="<?php echo !empty($begindatum)?$begindatum:'';?>">
                            <?php if (!empty($begindatumError)): ?>
                                <span class="help-inline"><?php echo $begindatumError;?></span>
                            <?php endif;?>
                        </div>
                        <div class="control-group <?php echo !empty($websiteError)?'error':'';?>">
                       <label class="control-label">Website</label>
                       <div class="controls">
                            <input name="website" type="text"  placeholder="Website" value="<?php echo !empty($website)?$website:'';?>">
                            <?php if (!empty($websiteError)): ?>
                                <span class="help-inline"><?php echo $websiteError;?></span>
                            <?php endif;?>
                        </div>
                           <div class="control-group <?php echo !empty($contactpersoonError)?'error':'';?>">
                        <label class="control-label">Contactpersoon</label>
                        <div class="controls">
                            <input name="contactpersoon" type="text"  placeholder="Contactpersoon" value="<?php echo !empty($contactpersoon)?$contactpersoon:'';?>">
                            <?php if (!empty($contactpersoonError)): ?>
                                <span class="help-inline"><?php echo $contactpersoonError;?></span>
                            <?php endif;?>
                        </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Opslaan</button>
                          <a class="btn" href="index.php">Terug</a>
                        </div>
                    </form>         
    </div> <!-- /container -->
  </body>
</html>