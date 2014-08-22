<?php
session_start();
include('connexion.php');

$message = '';
$ousername = '';
//On verifie si le formulaire a ete envoye
if (isset($_POST['username'], $_POST['password'])) {
    //On echappe les variables pour pouvoir les mettre dans des requetes SQL
    if (get_magic_quotes_gpc()) {
        $ousername = stripslashes($_POST['username']);
        $username = mysql_real_escape_string(stripslashes($_POST['username']));
        $password = stripslashes($_POST['password']);
    } else {
        $username = mysql_real_escape_string($_POST['username']);
        $password = $_POST['password'];
    }
    //On recupere le mot de passe de lutilisateur
    $req = mysql_query('select password,id,compteur from users where username="' . $username . '"') or die('Erreur SQL !<br><br>' . mysql_error());
    $dn = mysql_fetch_array($req);
    //On le compare a celui quil a entre et on verifie si le membre existe
    if ($dn['password'] == $password and mysql_num_rows($req) > 0) {

        //On enregistre son pseudo dans la session username

        $_SESSION['username'] = $_POST['username'];
        $compteur = $dn['compteur'] + 1;
        $username = $_POST['username'];
        $result = mysql_query("UPDATE users SET compteur='$compteur' WHERE username='$username'") or die(mysql_error());

        if ($username == 'admin') {
            header('Location: ./admin/index.php');
        }
    } else {
        //Sinon, on indique que la combinaison nest pas bonne

        $message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
    }
    mysql_close();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Accueil</title>
        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->             
        <link href="./css/signin.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy this line! -->
       <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <!-- ENTETE-->    



        <?php
        if (!isset($_SESSION['username'])) {
            ?>      
            <div class="form-signin entetelogin">         
                <a href="index.php"><img src="./images/logo.png" border="0"/></a>       
            </div>
            <div class="container">
                <div class="form-signinlogin">
                    <div class="panel panel-default">
                        <div class="panel-body"> 
                            <div  class="cadre" id="cadre" >
                                <form name="firstForm" class="form-signin" role="form" action="" method="post" >
                                    <h4 class="form-signin-heading"><span class="glyphicon glyphicon-log-in"></span> Connection</h4>
                                    <p>Nom utilisateur : <input type="text" class="form-control" name="username" placeholder="Nom utilisateur" required autofocus /></p>
                                    <p>Mot de passe : <input type="password" class="form-control" name="password" placeholder="Mot de passe" required /></p>
                                    <p><input type="submit" class="btn btn-primary" name="Valider" value="Valider"/></p>
                                    <p class="msgerreur"><?php echo $message ?></p>
                                    <a href="inscription.php" class="lien">inscrivez-vous</a> | <a href="oubliermp.php" class="lien">Oublier mot de passe ?</a>

                                </form></div>
                        </div> </div> </div> 
            </div>  

            <?php
        } else {
            ?>
            <div class="form-signin entete">         
                <a href="index.php"><img src="./images/logo.png" border="0"/></a>       
            </div>
            <div class="container">
                <div class="form-signin">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <nav>
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Acceuil</a></li>
                                    <li><a href="profil.php">Profil</a></li>
                                    <li><a href="preferences_utlisateur.php">Préferences</a></li>
                                                                     

                                        <li class="dropdown">
                                            <a id="drop4" role="button" data-toggle="dropdown" href="#">Affichage <b class="caret"></b></a>
                                            <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                                <li role="presentation"><?php echo '<a role="menuitem" tabindex="-1" href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?affichage=g">Graphe</a>'; ?> </li>
                                                <li role="presentation"><?php echo '<a role="menuitem" tabindex="-1" href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?affichage=h">Horizontal</a>'; ?></li>
                                            </ul>
                                    </li>
                                    <li class="danger" ><a class="logout" href="deconnecte.php"><span class="glyphicon glyphicon-log-out"></span> Déconnecté</a></li>

                                </ul>

                            </nav>
                            <br>
                            <div style="float: left;">
                                <b> Bonjour </b><a href="index.php?username=<?php echo $_SESSION['username']; ?><?php if (isset($_GET['affichage'])) echo '&affichage='.$_GET['affichage'];?>"><?php echo $_SESSION['username']; ?></a>
                            </div>
<div style="text-align: right;">
    <img src="./images/logofacebook.png" width="20" height="20"> <a href="facebook_connect.php"> Affinité avec vos amis facebook </a>
                          </div> <br>    
                            <?php include('affinite.php'); ?>



                        
                    </div>
                </div> 
                <?php
            }
            ?>  
            <!-- Bootstrap core JavaScript
          ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="./js/bootstrap.min.js"></script>                              

    </body>
</html>

