<?php
include('connexion.php');

$username = $_POST['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>INF3005 - Inscription</title>
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
                            <form action="enregistrement_profil.php" class="form-signin" role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="username" value="<?php echo $username; ?>" />
                                <table class='table table-condensed'>
                                    <tr class="success"><th><span class="glyphicon glyphicon-ok-sign"></span> Modifier préférences :</th></tr>      
                                    <?php
                                    $req1 = mysql_query('select * from users where username="' . $username . '"') or die(mysql_error());
                                    $dn = mysql_fetch_array($req1);
                                    $preferences = $dn['preferences'];
                                    $array = explode('|', $preferences);
                                    $array1 = array_pop($array);
                                    $exist = false;
                                    $value = '';
                                    
                                    
                                    $res1 = mysql_query("SELECT * FROM categories");
                                    
                                    while ($row = mysql_fetch_assoc($res1)) {
                                        $c = $row["id"];

                                        echo '<tr class="active"><td class="checkbox"><b>' . $row["nom"] . '</b></td></tr> ';

                                        $res2 = mysql_query("SELECT * FROM motscles WHERE idcat='" . $c . "'");
                                        while ($row1 = mysql_fetch_assoc($res2)) {
                                            $s = $row1["idcat"];
                                            
                                            if(in_array($row1["nom"], $array) )
                                                echo '<tr><td><input type="checkbox" name="choix[]" value="' . $row1["nom"] . '" checked> ' . $row1["nom"] . '</td></tr>';
                                            else
                                                echo '<tr><td><input type="checkbox" name="choix[]" value="' . $row1["nom"] . '"> ' . $row1["nom"] . '</td></tr>';
 
                                        }
                                    }
                                    ?>
                                </table>
                                <input type="submit" class="btn btn-primary" value="Enregistrer"/>

                            </form>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
    </body>
</html>
<?php
if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $nrue = $_POST['nrue'];
    $rue = $_POST['rue'];
    $ville = $_POST['ville'];
    $province = $_POST['province'];
    $cp = $_POST['cp'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $preferences = '';

    if (!empty($_POST['choix'])) {
        //on boucle
        for ($i = 0; $i < count($_POST['choix']); $i++) {
            //on concatène
            $preferences .= $_POST['choix'][$i] . '|';
        }
    }
    $photo = "default.jpg";
    if (!empty($_FILES["file"]["name"])) {
        $photo = $_POST['photo'];
    }
    if ($province == 'Province') {
        $province = '';
    }
    if ($nrue == '' && $rue == '' && $ville == '') {
        $pays = '';
    }


//  upload photo

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 100000)
            && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        } else {
//            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//            echo "Type: " . $_FILES["file"]["type"] . "<br>";
//            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

            if (file_exists("photos/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "photos/" . $_FILES["file"]["name"]);
                echo "Stored in: " . "photos/" . $_FILES["file"]["name"];
            }
        }
    } else {
      //  echo "Invalid file";
    }

   // $req = mysql_query('UPDATE users SET first_name = "' . $nom . '" ,  last_name = "' . $prenom . '" ,  email = "' . $email . '" ,  nrue = "' . $nrue . '" ,  rue = "' . $rue . '" ,  ville = "' . $ville . '" ,  province= "' . $province . '" ,  cp = "' . $cp . '" ,  pays = "' . $pays . '" ,  telephone = "' . $telephone . '" ,  photo = "' . $photo . '" , preferences = "' . $preferences. '" WHERE username = "' . $username . '"');
       $req = mysql_query('UPDATE users SET first_name = "' . $nom . '" ,  last_name = "' . $prenom . '" ,  email = "' . $email . '" ,  nrue = "' . $nrue . '" ,  rue = "' . $rue . '" ,  ville = "' . $ville . '" ,  province= "' . $province . '" ,  cp = "' . $cp . '" ,  pays = "' . $pays . '" ,  telephone = "' . $telephone . '" ,  photo = "' . $photo . '" WHERE username = "' . $username . '"');
    mysql_query($req);
    mysql_close();
}
?>