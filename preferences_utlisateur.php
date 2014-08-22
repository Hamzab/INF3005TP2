<?php
session_start();
include('connexion.php');

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $req = mysql_query('select * from users where username="' . $username . '"') or die(mysql_error());
    $dn = mysql_fetch_array($req);
    ?> 
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>INF3005 - Preferences</title>

            <!-- Bootstrap core CSS -->
            <link href="./css/bootstrap.min.css" rel="stylesheet">
            <!-- Custom styles for this template -->             
            <link href="./css/signin.css" rel="stylesheet">

            <script type='text/javascript' src='http://code.jquery.com/jquery-1.6.4.js'></script>

            <script type='text/javascript'>//<![CDATA[ 
                $(window).load(function(){
                    $(function() {
                        var motsclesDiv = $('#motscles');
                        var i = $('#motscles p').size() + 1;
                
                        $('#ajoutMotcle').live('click', function() {
                            if( i <= 5 ) {
                                $('<p><label for="motcle">Mot cle'+ i +' :<input type="text" class="form-control" id="motcle" size="50" name="motcle[]" value="" placeholder="Mot cle '+ i +'" /></label> <a href="#" id="suppMotcle" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a></p>').appendTo(motsclesDiv);
                                i++;
                            }
                            return false;
                        });
                
                        $('#suppMotcle').live('click', function() { 
                            if( i > 1 ) {
                                $(this).parents('p').remove();
                                i--;
                            }
                            return false;
                        });
                    });

                });//]]>  

            </script>
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
                            <nav>
                                <ul class="nav nav-pills">
                                    <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Acceuil</a></li>
                                    <li><a href="profil.php">Profil</a></li>
                                    <li class="active"><a href="preferences_utlisateur.php">Préferences</a></li>
                                    <li><a class="logout" href="deconnecte.php"><span class="glyphicon glyphicon-log-out"></span> Déconnecté</a></li>
                                </ul>
                            </nav>
                            <br>
                            <div  class="cadre" id="cadre" >


                                <form action="enregistrement_preferences.php" class="form-signin" role="form" method="post" enctype="multipart/form-data">
                                    <label>Catégorie: </label>
                                    <input type="text" class="form-control" name="categorie" value="" placeholder="Catégorie" />
                                    <br><a href="#" id="ajoutMotcle"><span class="glyphicon glyphicon-plus"></span> Ajouter un mot cle</a>
                                    <div id="motscles">

                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Enregistrer"/>
                                    <a class="btn btn-default" href="./index.php" role="button">Retour</a>
                                </form>

                            </div>




                        </div>
                    </div>
                </div>
            </div> 
            <?php
        }else
            header('Location: ./index.php');
        ?>    
    </body>
</html>
