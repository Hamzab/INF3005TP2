<?php
include('connexion.php');

?>
<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $preferences = '';

    if (!empty($_POST['choix'])) {
        //on boucle
        for ($i = 0; $i < count($_POST['choix']); $i++) {
            //on concatène
            $preferences .= $_POST['choix'][$i] . '|';
        }
    }


    $req = mysql_query('UPDATE users SET preferences = "' . $preferences . '" WHERE username = "' . $username . '"');
    mysql_query($req);
    mysql_close();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Enregistrement</title>
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
                            <br><br><br><br><h8>Vos informations ont été enregistrées avec succès.</h8><br><br><br>
                            <a class="btn btn-default btn-lg" href="./index.php" role="button">Retour</a>
                        </div>      <br><br><br><br>
                    </div> </div> </div>
        </div>
    </body>
</html>