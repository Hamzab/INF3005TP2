<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>JSP Page</title>
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
                        <div  class="cadre" id="cadre" >

                            <p class="titre1"><b> <span class="glyphicon glyphicon-user"></span> Ajouter utilisateur :</b></p>
                          
                            <form action="ajouter_preferences.php" class="form-signin" role="form" method="post" enctype="multipart/form-data">                           
                                <label>Nom d'utilisateur : </label>
                                <input type="text" class="form-control" name="username" value="" placeholder="Nom utilisateur" required autofocus />
                                <label>Mot de passe : </label>
                                <input type="password" class="form-control" name="password" value="" placeholder="Mot de passe" required />
                                <label>Nom : </label>
                                <input type="text" class="form-control" name="nom" value="" placeholder="Nom" required />
                                <label>Prénom : </label>
                                <input type="text" class="form-control" name="prenom" value="" placeholder="Prénom" required />
                                <label>Courriel : </label>
                                <input type="email" class="form-control" name="email" value="" placeholder="Courriel" required />
                                <label>Adresse : </label>               
                                <div class="row">

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" name="nrue" placeholder="N&deg;Rue">
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="rue" placeholder="Rue">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">

                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" name="ville" placeholder="Ville">
                                    </div>
                                    <div class="col-xs-5">
                                        <select class="form-control" name="province"> 
                                            <option>Province</option>
                                            <option> </option>
                                            <option value="AB">AB</option>
                                            <option value="BC">BC</option>
                                            <option value="MB">MB</option>
                                            <option value="NB">NB</option>
                                            <option value="NL">NL</option>
                                            <option value="NS">NS</option>
                                            <option value="NT">NT</option>
                                            <option value="NU">NU</option>
                                            <option value="ON">ON</option>
                                            <option value="PE">PE</option>
                                            <option value="QC">QC</option>
                                            <option value="SK">SK</option>
                                            <option value="YT">YT</option>	
                                        </select> 
                                    </div>
                                </div>
                                <br/>
                                <div class="row">

                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="cp" placeholder="Code postal">
                                    </div>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" name="pays" placeholder="Pays" value="Canada">
                                    </div>
                                </div>  
                                <label>Téléphone : </label>
                                <input type='tel' name="telephone" class="form-control" pattern='[\(]\d{3}[\)]\d{3}[\-]\d{4}' title='Phone Number (Format: (999)999-9999)'> 

                                <label>Photo : </label>
                                <input type="file" class="form-control" name="file"/></br>
                                <input type="submit" class="btn btn-primary" value="Suivant"/>  <a class="btn btn-default" href="./utilisateurs.php" role="button">Retour</a></p

                            </form>
                        </div>       
                    </div>       
                </div>  
            </div>
        </div>
    </body>
</html>