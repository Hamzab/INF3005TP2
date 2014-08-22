<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Email</title>
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

                        <div class="logouttext">
                            <br><br><br><br>
                            <?php
                            $message = $_POST['message'];
                            $email = $_POST['useremail'];
                            $sujet = $_POST['objet'];
                            $destinataire = $_POST['email'];

                            $headers = 'From: ' . $email . "\n";
                            $headers .='Reply-To: ' . $email . "\n";
                            $headers .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
                            $headers .='Content-Transfer-Encoding: 8bit';

                            if (mail($destinataire, $sujet, $message, $headers)) {
                                echo '<h8>Le message a été envoyé</h8>';
                            } else {
                                echo '<h8>Le message n\'a pu être envoyé</h8>';
                            }
                            ?>
                            <br>
                            <br>
                            <br>
                            <a class="btn btn-default btn-lg" href="./index.php" role="button">Retour</a>
                        </div>      
                        <br>
                        <br>
                        <br>
                        <br>
                    </div> 
                </div> 
            </div>
        </div>
    </body>
</html>
