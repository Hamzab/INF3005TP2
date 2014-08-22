<?php
session_start();
//Si lutilisateur est connecte, on le deconecte

if (isset($_SESSION['username']))

//On le deconecte en supprimant simplement les sessions username et userid
    unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Déconnexion</title>
        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->              
        <link href="./css/signin.css" rel="stylesheet">
    </head>
    <body>
        <!-- ENTETE-->    

        <div class="form-signin entete">         
            <a href="index.php"><img src="./images/logo.png" border="0"/></a>       
        </div>           
        <div class="container">
            <div class="form-signin">
                <div class="panel panel-default">
                    <div class="panel-body"> 

                        <div class="logouttext">
                            <br><br><br><br><h8>Vous avez été déconnecté avec succès.</h8><br><br><br>
                            <a class="btn btn-default btn-lg" href="./index.php" role="button">Retour</a>
                        </div>      <br><br><br><br>
                    </div> </div> </div>
        </div>
    </body>
</html>
