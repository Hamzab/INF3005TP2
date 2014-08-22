<?php 

session_start(); // initialize session 
if (isset($_COOKIE)) {
    foreach($_COOKIE as $name => $value) {
        if ($name != "username") // Name of the cookie you want to preserve 
        {
            setcookie($name, '', 1); // Better use 1 to avoid time problems, like timezones
            setcookie($name, '', 1, '/');
        }
    }
}
header("Location: facebook_connect.php");
?>
