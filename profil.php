<?php
session_start();
include('connexion.php');

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $req = mysql_query('select * from users where username="' . $username . '"') or die(mysql_error());
    $dn = mysql_fetch_array($req);
    ?> 
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>INF3005 - Profil</title>

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
                            <nav>
                                <ul class="nav nav-pills">
                                    <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Acceuil</a></li>
                                    <li class="active"><a href="profil.php">Profil</a></li>
                                    <li><a href="preferences_utlisateur.php">Préferences</a></li>
                                    <li><a class="logout" href="deconnecte.php"><span class="glyphicon glyphicon-log-out"></span> Déconnecté</a></li>
                                </ul>
                            </nav>
                            <br>
                            <div  class="cadre" id="cadre" >
                                <?php echo'<img src="./photos/' . $dn['photo'] . '" width="100" height="100" border="1"/>'; ?><br>
                                <label>Nom : </label>
                                <?php echo $dn['first_name']; ?><br>
                                <label>Prénom : </label>
                                <?php echo $dn['last_name']; ?><br>
                                <label>Courriel : </label>
                                <?php echo $dn['email']; ?><br>
                                <label>Adresse : </label>               
                                <?php
                                echo $dn['nrue'] . ', ';
                                echo $dn['rue'] . ' ';
                                echo ' ' . $dn['ville'] . ' ';
                                echo $dn['province'] . ' ';
                                echo $dn['cp'] . ' ';
                                echo $dn['pays'];
                                ?><br>  
                                <label>Téléphone : </label>
                                <?php echo $dn['telephone']; ?><br>
                                <label>Préferences : </label>
                                <?php
                                $preferences = $dn['preferences'];
                                $array = explode('|', $preferences);
                                $array1 = array_pop($array);
                                $last_key = end($array);
                                foreach ($array as $value) {
                                    echo $value;
                                    if ($value === $last_key) {
                                        echo ".";
                                    }else
                                        echo ", ";
                                }
                                ?><br><br>

                                <a class="btn btn-primary" href="./modifier_profil.php?username=<?php echo $dn['username']; ?>" role="button">Modifier</a>
                                <a class="btn btn-default" href="./index.php" role="button">Retour</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
    <?php
}else
    header('Location: ./index.php');
?>    
    </body>
</html>
