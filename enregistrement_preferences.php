<?php

$categorie = $_POST['categorie'];  
$preferences_user='';

    if (!empty($_POST['motcle'])) {
        //on boucle
        for ($i = 0; $i < count($_POST['motcle']); $i++) {
            //on concatène
            $preferences_user .= $_POST['motcle'][$i] . '|';
        }
    }
    echo $categorie.'<br>'.$preferences_user;
    
?>
