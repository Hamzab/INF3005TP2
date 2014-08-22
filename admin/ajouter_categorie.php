<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title></title>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../css/signin.css" rel="stylesheet">
    </head>
    <body>
        <!-- ENTETE-->    

        <div class="form-signin entete">         
            <a href="index.php"><img src="../images/logo.png" border="0"/></a>       
        </div>
        <div class="container">
            <div class="form-signin">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="ajouter_1.php" class="form-signin" role="form" method="post">
                            <h4 class="form-signin-heading" >Ajouter categorie :</h4>
                            <label>Categorie: </label>
                            <input type="text" class="form-control" name="nom" value="" />
                            </br>
                            <input type="submit" class="btn btn-primary" value="Enregistrer"/>  <a class="btn btn-default" href="./categories.php" role="button">Retour</a></p

                        </form>
                    </div>       
                </div>       
            </div>       
        </div>
    </body>
</html>