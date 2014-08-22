<?php

include('connexion.php');


if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
else
    $username = $_SESSION['username'];

$res = mysql_query('select * from users where username="' . $username . '"') or die('Erreur SQL !<br><br>' . mysql_error());
$dn = mysql_fetch_array($res);
$preferences1 = $dn['preferences'];

$user1 = '';
$user2 = '';
$user3 = '';
$user4 = '';
$max1 = 0;
$max2 = 0;
$max3 = 0;
$max4 = 0;
$pref1 = '';
$pref2 = '';
$pref3 = '';
$pref4 = '';
$photo1 = '';
$photo2 = '';
$photo3 = '';
$photo4 = '';
$email1 = '';
$email2 = '';
$email3 = '';
$email4 = '';

$req = mysql_query('select * from users where username!="' . $username . '"') or die(mysql_error());

while ($row = mysql_fetch_assoc($req)) {

    $preferences2 = $row['preferences'];
    $pourcentage = comparer($preferences1, $preferences2);
    if ($pourcentage > $max1) {
        $max2 = $max1;
        $user2 = $user1;
        $pref2 = $pref1;
        $photo2 = $photo1;
        $email2 = $email1;
        $max1 = $pourcentage;
        $user1 = $row['username'];
        $pref1 = $row['preferences'];
        $photo1 = $row['photo'];
        $email1 = $row['email'];
    } else if ($pourcentage > $max2) {
        $max3 = $max2;
        $user3 = $user2;
        $pref3 = $pref2;
        $photo3 = $photo2;
        $email3 = $email2;
        $max2 = $pourcentage;
        $user2 = $row['username'];
        $pref2 = $row['preferences'];
        $photo2 = $row['photo'];
        $email2 = $row['email'];
    } else if ($pourcentage > $max3) {
        $max4 = $max3;
        $user4 = $user3;
        $pref4 = $pref3;
        $photo4 = $photo3;
        $email4 = $email3;
        $max3 = $pourcentage;
        $user3 = $row['username'];
        $pref3 = $row['preferences'];
        $photo3 = $row['photo'];
        $email3 = $row['email'];
    } else if ($pourcentage > $max4) {
        $max4 = $pourcentage;
        $user4 = $row['username'];
        $pref4 = $row['preferences'];
        $photo4 = $row['photo'];
        $email4 = $row['email'];
    }
}

function comparer($preferences1, $preferences2) {
    $array1 = explode('|', $preferences1);
    $array2 = explode('|', $preferences2);
    $array = array_pop($array1);
    $array = array_pop($array2);

    $result = array_intersect($array1, $array2);
    // print_r($result);

    $Nombre = count($result);
    $Total = count($array1);

    return Pourcentage($Nombre, $Total);
}

function Pourcentage($Nombre, $Total) {
    return round($Nombre * 100 / $Total, 2);
}

function ConvertToTab($preferences) {

    $array = explode('|', $preferences);
    $array1 = array_pop($array);
    return $array;
}

function Affichage($preferences) {

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
}

if (isset($_GET['affichage']))
    $affichage = $_GET['affichage'];
else
    $affichage = 'g';
// Affichage 1
if ($affichage == 'h') {
    echo '<div class="cadre"><table class="table table-condensed" width=100% border="0"><tr class="success"><td><b>Utilisateur :</b> ' . $username . '  <br><b>Preferences :</b> ';
    Affichage($preferences1);
    echo '</td></tr>';

    echo '<tr><td><img class="cadre2" src="./photos/' . $photo1 . '" width="50" height="50" border="1"/> <a href="index.php?username=' . $user1 . '&affichage=h"><span class="glyphicon glyphicon-user"></span> ' . $user1 . '</a> <BR><b> Affinité :</b> ' . $max1 . '% <br><b>Preferences :</b> ';
    Affichage($pref1);
    echo '<BR><a href="ecrire_message.php?email=' . $email1 . '"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></td></tr>';
    echo '<tr class="active"><td><img class="cadre2" src="./photos/' . $photo2 . '" width="50" height="50" border="1"/> <a href="index.php?username=' . $user2 . '&affichage=h"><span class="glyphicon glyphicon-user"></span> ' . $user2 . '</a> <BR><b> Affinité :</b> ' . $max2 . '% <br><b>Preferences :</b> ';
    Affichage($pref2);
    echo '<BR><a href="ecrire_message.php?email=' . $email2 . '"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></td></tr>';
    echo '<tr><td><img class="cadre2" src="./photos/' . $photo3 . '" width="50" height="50" border="1"/> <a href="index.php?username=' . $user3 . '&affichage=h"><span class="glyphicon glyphicon-user"></span> ' . $user3 . '</a> <BR><b> Affinité :</b> ' . $max3 . '% <br><b>Preferences :</b> ';
    Affichage($pref3);
    echo '<BR><a href="ecrire_message.php?email=' . $email3 . '"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></td></tr>';
    echo '<tr class="active"><td><img class="cadre2" src="./photos/' . $photo4 . '" width="50" height="50" border="1"/> <a href="index.php?username=' . $user4 . '&affichage=h"><span class="glyphicon glyphicon-user"></span> ' . $user4 . '</a> <BR><b> Affinité :</b> ' . $max4 . '% <br><b>Preferences :</b> ';
    Affichage($pref4);
    echo '<BR><a href="ecrire_message.php?email=' . $email4 . '"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></td></tr>';
    echo '</table></div>';
} else {
// Affichage 2

    echo '<div class="cadre"><table width=100% border="0"><tr><td align="center"><div class="left"> </div></td>';
    echo '<td align="center"><div class="panel panel-default left"><div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <a href="index.php?username=' . $user1 . '">' . $user1 . '</a></div><div class="panel-body"><img class="cadre2" src="./photos/' . $photo1 . '" width="50" height="50" border="1"/>  <p><b style="{color:blue;}"> Affinité :</b> ' . $max1 . '% </p><b>Preferences :</b> ';
    Affichage($pref1);
    echo '<br><a href="ecrire_message.php?email=' . $email1 . '" title="Ecrire message"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></div></div></td>';
    echo '<td align="center"><div class="left"> </div/td></tr><tr>';
    echo '<td align="right"><div class="panel panel-default left"><div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <a href="index.php?username=' . $user2 . '">' . $user2 . '</a></div><div class="panel-body"><img class="cadre2" src="./photos/' . $photo2 . '" width="50" height="50" border="1"/>  <p><b> Affinité :</b> ' . $max2 . '% </p><b>Preferences :</b> ';
    Affichage($pref2);
    echo '<br><a href="ecrire_message.php?email=' . $email2 . '" title="Ecrire message"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></div></div></td>';
    echo '<td align="center" class="img"><div class="panel panel-success left"><div class="panel-heading"><a href="index.php?username=' . $username . '">' . $username . '</a></div></p><div class="panel-body"><br><b>Preferences :</b> ';
    Affichage($preferences1);
    echo '</div></div>';
    echo '<td align="left"><div class="panel panel-default left"><div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <a href="index.php?username=' . $user3 . '">' . $user3 . '</a></div><div class="panel-body"><img class="cadre2" src="./photos/' . $photo3 . '" width="50" height="50" border="1"/>  <p><b> Affinité :</b> ' . $max3 . '% </p><b>Preferences :</b> ';
    Affichage($pref3);
    echo '<br><a href="ecrire_message.php?email=' . $email3 . '" title="Ecrire message"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></div></div></td></tr><tr>';
    echo '<td align="center"><div> </div class="left"></td>';
    echo '<td align="center"><div class="panel panel-default left"><div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <a href="index.php?username=' . $user4 . '">' . $user4 . '</a></div><div class="panel-body"><img class="cadre2" src="./photos/' . $photo4 . '" width="50" height="50" border="1"/>  <p><b> Affinité :</b> ' . $max4 . '% </p><b>Preferences :</b> ';
    Affichage($pref4);
    echo '<br><a href="ecrire_message.php?email=' . $email4 . '" title="Ecrire message"><span class="glyphicon glyphicon-envelope"></span> Envoyer message</a></div></div></td>';
    echo '<td align="center"><div class="left"> </div></td></tr></table></div>';
}
?>

