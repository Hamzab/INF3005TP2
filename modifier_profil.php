<?php
session_start();
include('connexion.php');

$username = $_GET['username'];
$req = mysql_query('select * from users where username="' . $username . '"') or die(mysql_error());
$dn = mysql_fetch_array($req);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>INF3005 - Modifier profil</title>
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
                        
                        <div class="cadre">
                            <p class="titre"><b> <span class="glyphicon glyphicon-user"></span> Modifier profil :</b></p>
                            <form action="modifier_preferences.php" class="form-signin" role="form" method="post" enctype="multipart/form-data">
                                <!--                            <label>Nom d'utilisateur : </label>-->
                                <input type="hidden" class="form-control" name="username" value="<?php echo $dn['username']; ?>" placeholder="Nom utilisateur" required autofocus />
                                <!--                            <label>Mot de passe : </label>-->
                                <input type="hidden" class="form-control" name="password" value="<?php echo $dn['password']; ?>" placeholder="Mot de passe" required />
                                <label>Nom : </label>
                                <input type="text" class="form-control" name="nom" value="<?php echo $dn['first_name']; ?>" placeholder="Nom" required />
                                <label>Prénom : </label>
                                <input type="text" class="form-control" name="prenom" value="<?php echo $dn['last_name']; ?>" placeholder="Prénom" required />
                                <label>Courriel : </label>
                                <input type="email" class="form-control" name="email" value="<?php echo $dn['email']; ?>" placeholder="Courriel" required />
                                <label>Adresse : </label>               
                                <div class="row">

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" name="nrue" value="<?php echo $dn['nrue']; ?>" placeholder="N&deg;Rue">
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="rue" value="<?php echo $dn['rue']; ?>" placeholder="Rue">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">

                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" name="ville" value="<?php echo $dn['ville']; ?>" placeholder="Ville">
                                    </div>
                                    <div class="col-xs-5">
                                        <select class="form-control" name="province"> 

                                            <option>Province</option>
                                            <option<?php
if ($dn['province'] == '') {
    echo ' selected';
}
?>> </option>
                                            <option value="AB"<?php
if ($dn['province'] == 'AB') {
    echo ' selected';
}
?>>AB</option>
                                            <option value="BC"<?php
                                                    if ($dn['province'] == 'BC') {
                                                        echo ' selected';
                                                    }
?>>BC</option>
                                            <option value="MB"<?php
                                            if ($dn['province'] == 'MB') {
                                                echo ' selected';
                                            }
?>>MB</option>
                                            <option value="NB"<?php
                                            if ($dn['province'] == 'NB') {
                                                echo ' selected';
                                            }
?>>NB</option>
                                            <option value="NL"<?php
                                                    if ($dn['province'] == 'NL') {
                                                        echo ' selected';
                                                    }
?>>NL</option>
                                            <option value="NS"<?php
                                            if ($dn['province'] == 'NS') {
                                                echo ' selected';
                                            }
?>>NS</option>
                                            <option value="NT"<?php
                                            if ($dn['province'] == 'NT') {
                                                echo ' selected';
                                            }
?>>NT</option>
                                            <option value="NU"<?php
                                                    if ($dn['province'] == 'NU') {
                                                        echo ' selected';
                                                    }
?>>NU</option>
                                            <option value="ON"<?php
                                                    if ($dn['province'] == 'ON') {
                                                        echo ' selected';
                                                    }
?>>ON</option>
                                            <option value="PE"<?php
                                                    if ($dn['province'] == 'PE') {
                                                        echo ' selected';
                                                    }
?>>PE</option>
                                            <option value="QC"<?php
                                                    if ($dn['province'] == 'QC') {
                                                        echo ' selected';
                                                    }
?>>QC</option>
                                            <option value="SK"<?php
                                                    if ($dn['province'] == 'SK') {
                                                        echo ' selected';
                                                    }
?>>SK</option>
                                            <option value="YT"<?php
                                                    if ($dn['province'] == 'YT') {
                                                        echo ' selected';
                                                    }
?>>YT</option>
                                        </select> 
                                    </div>
                                </div>
                                <br/>
                                <div class="row">

                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="cp" value="<?php echo $dn['cp']; ?>" placeholder="Code postal">
                                    </div>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" name="pays" value="<?php echo $dn['pays']; ?>" placeholder="Pays">
                                    </div>
                                </div>  
                                <label>Téléphone : </label>
                                <input type='tel' name="telephone" value="<?php echo $dn['telephone']; ?>" class="form-control" pattern='[\(]\d{3}[\)]\d{3}[\-]\d{4}' title='Phone Number (Format: (999)999-9999)'> 

                                <label>Photo : </label>
                                <input type="file" value="<?php echo $dn['photo']; ?>" class="form-control" name="file" /></br>
                                <input type="hidden" name="photo" value="<?php echo $dn['photo']; ?>">
                                <a class="btn btn-default" href="./index.php" role="button">Retour</a> <input type="submit" class="btn btn-primary" value="Suivant >> "/>
                            </form>
                        </div>   
                    </div> 
                </div>       
            </div>       
        </div>
    </body>
</html>