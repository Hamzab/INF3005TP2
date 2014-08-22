<?php
session_start();
include('connexion.php');

if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
else
    $username = $_SESSION['username'];

$res = mysql_query('select * from users where username="' . $username . '"') or die('Erreur SQL !<br><br>' . mysql_error());
$dn = mysql_fetch_array($res);
$emailuser = $dn['email'];
$email = $_GET['email'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Message</title>
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
                        <form action="envoyer_message.php" class="form-signin" role="form" method="post">
                            <h4 class="form-signin-heading">Message :</h4>
                           
                            <input type="hidden" class="form-control" name="useremail" value="<?php echo $emailuser; ?>"/>
                            <label>Destinataire : </label>
                            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"/>                           
                            <label>Objet : </label>
                            <input type="text" class="form-control" name="objet" value=""/>  
                            <label>Message : </label>
                            <textarea rows="4" cols="50"  class="form-control" name="message"></textarea><br> 
                            <input type="submit" class="btn btn-primary" value="Envoyer"/>
                            <a class="btn btn-default" href="index.php">Retour </a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </body>       
</html>    
