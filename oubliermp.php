<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Oublier mot de passe</title>
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
                            <form name="firstForm" class="form-signin" role="form" action="recuperer.php" method="post" >
                                <h4 class="form-signin-heading"><span class="glyphicon glyphicon-share"></span> Récupérer mot de passe :</h4><br><br>
                                <label>Courriel : </label><br/>
                                <input type="email" class="form-control" name="email" value="" placeholder="Courriel" required /><br/>
                                <p><input type="submit" class="btn btn-primary" name="Valider" value="Envoyer"/>  <a class="btn btn-default" href="./index.php" role="button">Retour</a></p>

                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>