<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Administration</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->              
        <link href="../css/signin.css" rel="stylesheet">
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mot cle', 'pourcentage'],
          ['Soccer',     11],
          ['Rai',      2],
          ['Cinema',  2],
          ['Facebook', 2],
          ['Twitter',    7]
        ]);

        var options = {
          title: 'Mots clés par catégorie',
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  
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
                        <nav>
                            <ul class="nav nav-pills">
                                <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Acceuil</a></li>
                                <li><a href="utilisateurs.php" title="Utilisateurs">Utilisateurs</a></li>
                                <li><a href="categories.php" title="Catégories">Catégories</a></li>
                                <li><a href="motscles.php" title="Mots clés">Mots clés</a></li>
                                <li><a class="logout" href="../deconnecte.php"><span class="glyphicon glyphicon-log-out"></span> Déconnecté</a></li>
                            </ul>
                        </nav>
<br>
    <div  class="cadre" id="piechart"></div>
 </div>      
                </div> </div> </div>
   
</body>
</html>