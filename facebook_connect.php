<?php
session_start();
include('connexion.php');
require_once './api/facebook.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
else
    $username = $_SESSION['username'];

$res = mysql_query('select * from users where username="' . $username . '"') or die('Erreur SQL !<br><br>' . mysql_error());
$dn = mysql_fetch_array($res);
$preferences1 = $dn['preferences'];

$facebook = new Facebook(array(
            'appId' => '1408331706101768',
            'secret' => '76248f135f332197f048e35028e3bd71',
            'allowSignedRequest' => false
        ));

// Obtenir User ID
$user = $facebook->getUser();

if ($user) {
    try {
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

// Login ou logout url tout dépend du status de l'utilisateur.
if ($user) {
    $logout_params = array('next' => 'http://moka.labunix.uqam.ca/~jk691240/tp2/logout.php');
    $logoutUrl = $facebook->getLogoutUrl($logout_params);
    $response = $facebook->api("/me/friends?fields=name%2Cpicture%2Cinterests.fields(name,category)%2Cemail&limit=5000&offset=0");
} else {
    $statusUrl = $facebook->getLoginStatusUrl();
    $login_params = array(
        'scope' => 'email',
        'display' => 'popup'
    );
    $loginUrl = $facebook->getLoginUrl($login_params);
}
?>
<!doctype html>
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
                                <li class="danger" ><a class="logout" href="deconnecte.php"><span class="glyphicon glyphicon-log-out"></span> Déconnecté</a></li>

                            </ul>

                        </nav>
                        <br>
                        <div style="float: left;">
                        </div>
                        <div style="text-align: right;">
                            <img src="./images/logofacebook.png" width="20" height="20"> 
                            <?php if ($user): ?>
                                <a href="<?php echo $logoutUrl; ?>">Déconnecté</a>
                            <?php else: ?>

                                <a href="<?php echo $loginUrl; ?>">Connecté avec Facebook</a>
                                <br><br><br><br><h8><p align="center">Vous n'êtes pas connecté.</p></h8><br><br><br>
                            <?php endif ?>
                        </div> <br>  

                        <?php
                        include('affinite_facebook.php');
                        if ($user) {
                            echo '<div class="cadre"><table class="table table-condensed" width=100% border="0"><tr class="success"><td><b>Utilisateur :</b> ' . $user_profile['name'] . '  <br><b>Preferences :</b> ';
                            //Affichage($preferences1);

                            echo '</td></tr>';

                            foreach ($response as $membre) {

                                $numItems = count($membre);
                                $i = 0;
                                
                                foreach ($membre as $elem) {
                                    unset($preferences);
                                    $preferences = array();
                                    if (++$i !== $numItems) {

                                        foreach ($elem as $key => $value) {

                                            if ($key === "name")
                                                $nom = $value;

                                            if ($key === "id")
                                                $email = $value;
                                            if ($key === "interests") {

                                                foreach ($value as $data) {
                                                    foreach ($data as $elem) {
                                                        $numItems = count($elem);
                                                        $i = 0;
                                                        if (++$i !== $numItems) {
                                                            foreach ($elem as $k => $v) {

                                                                if ($k === "name") {
                                                                    array_push($preferences, $v);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            if ($key === "picture") {
                                                foreach ($value as $data) {
                                                    foreach ($data as $k => $v) {
                                                        if ($k === "url") {
                                                            $photo = $v;
                                                            echo '<tr><td><img class="cadre2" src="' . $photo . '" width="50" height="50" border="1"/> <a href="index.php?username=' . $nom . '&affichage=h"><span class="glyphicon glyphicon-user"></span> ' . $nom . '</a> <BR><b> Affinité :</b> ';
                                                            if(comparer($preferences1, $preferences)) comparer($preferences1, $preferences); else echo "0";
                                                            echo ' % <br><b>Preferences :</b>';
                                                            Affichage($preferences);
                                                            echo '<BR><a href="ecrire_message.php?email=' . $email . '"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></td></tr>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo '</table></div>';
                        }
                        ?>
                    </div>
                </div> 

                <!-- Bootstrap core JavaScript
                ================================================== -->
                <!-- Placed at the end of the document so the pages load faster -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script src="./js/bootstrap.min.js"></script>         
                </body>
                </html>