<?php




function comparer($preferences1, $preferences2) {
    
    $array1 = explode('|', $preferences1);
    $array2 = $preferences2;
    $array = array_pop($array1);
    
    $result = array_intersect($array1, $array2);
 
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
    $array = $preferences;
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
?>
