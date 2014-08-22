<?php
include('../connexion.php');

$id = $_GET['id'];
$req = mysql_query('select * from categories where id="' . $id . '"') or die(mysql_error());
$dn = mysql_fetch_array($req);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title></title>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../css/signin.css" rel="stylesheet">
    </head>
    <body>
        <!-- ENTETE-->    

        <div class="form-signin entete">         
            <a href="index.php"><img src="../images/logo.png" border="0"/></a>       
        </div>
        <div class="container">
            <div class="form-signin">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="enregistrement_categorie.php" class="form-signin" role="form" method="post">
                            <h4 class="form-signin-heading" >Modifier categorie :</h4>
                            <input type="hidden" name="id" value="<?php echo $id ; ?>" />
                            <label>Categorie: </label>
                            <input type="text" class="form-control" name="nom"  value="<?php echo $dn['nom']; ?>" />
                            </br>
                            <input type="submit" class="btn btn-primary" value="Enregistrer"/>  <a class="btn btn-default" href="./categories.php" role="button">Retour</a></p

                        </form>
                    </div>       
                </div>       
            </div>       
        </div>
    </body>
</html>