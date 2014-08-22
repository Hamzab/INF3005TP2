<?php
include('../connexion.php');

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_ss = 10;
$pageNum_ss = 0;
if (isset($_GET['pageNum_ss'])) {
    $pageNum_ss = $_GET['pageNum_ss'];
}
$startRow_ss = $pageNum_ss * $maxRows_ss;

$query_ss = "SELECT * FROM motscles";
$query_limit_ss = sprintf("%s LIMIT %d, %d", $query_ss, $startRow_ss, $maxRows_ss);
$ss = mysql_query($query_limit_ss) or die(mysql_error());
$row_ss = mysql_fetch_assoc($ss);

if (isset($_GET['totalRows_ss'])) {
    $totalRows_ss = $_GET['totalRows_ss'];
} else {
    $all_ss = mysql_query($query_ss);
    $totalRows_ss = mysql_num_rows($all_ss);
}
$totalPages_ss = ceil($totalRows_ss / $maxRows_ss) - 1;

if (!empty($_POST['supprimer'])) {
    foreach ($_POST['supprimer'] as $cle) {
        $Requete = "DELETE FROM motscles WHERE id = '$cle'";
        $resRequete = mysql_query($Requete) or die(mysql_error());
    }
    header("Refresh: 1;URL=motscles.php");
}

$queryString_ss = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_ss") == false &&
                stristr($param, "totalRows_ss") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_ss = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_ss = sprintf("&totalRows_ss=%d%s", $totalRows_ss, $queryString_ss);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INF3005 - Gestion des mots cles</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->              
        <link href="../css/signin.css" rel="stylesheet">

        <script type="text/javascript" language="javascript">

            function SetAllCheckBoxes(FormName, FieldName, CheckValue)
            {
                if(!document.forms[FormName])
                    return;
                var objCheckBoxes = document.forms[FormName].elements[FieldName];
                if(!objCheckBoxes)
                    return;
                var countCheckBoxes = objCheckBoxes.length;
                if(!countCheckBoxes)
                    objCheckBoxes.checked = CheckValue;
                else
                // set the check value for all check boxes
                    for(var i = 0; i < countCheckBoxes; i++)
                        objCheckBoxes[i].checked = CheckValue;
            }

            function confirme( identifiant )
            {
                var confirmation = confirm( "Voulez vous vraiment supprimer cet enregistrement ?" ) ;
                if( confirmation )
                {
                    document.location.href = "supprimer_motcle.php?id="+identifiant ;
                }
            }

            function add( nom ) { 
                document.getElementById( nom ).value ++; 
            } 
            
            function substract( nom ) { 
                if(document.getElementById( nom ).value > 1)
                    document.getElementById( nom ).value --; 
            } 

            function isNumberKey(evt) 
            { 
                var charCode = (evt.which) ? evt.which : event.keyCode 
                if (charCode > 31 && (charCode < 48 || charCode > 57)) 
                    return false; 
                return true; 
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
                                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Acceuil</a></li>
                                <li><a href="utilisateurs.php" title="Utilisateurs">Utilisateurs</a></li>
                                <li><a href="categories.php" title="Catégories">Catégories</a></li>
                                <li class="active"><a href="motscles.php" title="Mots clés">Mots clés</a></li>
                                <li><a class="logout" href="../deconnecte.php"><span class="glyphicon glyphicon-log-out"></span> Déconnecté</a></li>
                            </ul>
                        </nav>
                        </br>
                        <div  class="cadre" id="cadre" >

                            <p class="titre1"><b> <span class="glyphicon glyphicon-pencil"></span> Gestion des mots clés :</b></p>
                            </br>
                            <form name="formu" method="post" action="">
                                <table class="table table-condensed" width="100%"  border="0" cellpadding="0" cellspacing="0">
                                    <tr class="active">
                                        <th></th>
                                        <th >Id</th>
                                        <th>Nom</th>
                                        <th>Catégorie</th>                                
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $couleur = 0;
                                    do {
                                        if ($couleur == 0) {
                                            $couleur = 1;
                                            $bg = "#ffffff";
                                        } else {
                                            $couleur = 0;
                                            $bg = "#FCFCFC";
                                        }
                                        ?>

                                        <tr OnMouseOver="this.style.backgroundColor = '#E4EFFF';" OnMouseOut="this.style.backgroundColor = '<?php echo $bg; ?>';" style="background-color:<?php echo $bg; ?>; ">
                                            <td valign="middle"><input name="supprimer[]" type="checkbox" id="supprimer[]" value="<?php echo $row_ss['id']; ?>"></td>
                                            <td align="left" valign="middle"><?php echo $row_ss['id']; ?></td>
                                            <td align="left" valign="middle"><?php echo $row_ss['nom']; ?></td>
                                            <td valign="middle">
                                                <?php
                                                $req = mysql_query('select * from categories where id="' . $row_ss['idcat'] . '"') or die(mysql_error());
                                                $dn = mysql_fetch_array($req);
                                                echo $dn['nom'];
                                                ?>
                                            </td>
                                            <td align="left">
                                                <a href="modifier_motcle.php?id=<?php echo $row_ss['id']; ?>" title="Modifier"><span class="glyphicon glyphicon-edit"></span></a>  

                                                <a href="#" onClick="confirme('<?php echo $row_ss['id']; ?>')" title="Supprimer"><span class="glyphicon glyphicon-remove" color="red"></span></a></td>

                                            <td valign="middle">&nbsp;</td>
                                        </tr>
                                    <?php } while ($row_ss = mysql_fetch_assoc($ss)); ?>
                                    <tr>
                                        <td colspan="7"> <br>
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#C4C4C4">
                                                <tr>
                                                    <td ><img src="../images/arrow_ltr.png" width="38" height="22" border="0"> 
                                                        <a href="#" onClick="SetAllCheckBoxes('formu', 'supprimer[]', true);"> <span>Cocher</span></a><span> | 
                                                            <a href="#" onClick="SetAllCheckBoxes('formu', 'supprimer[]', false);">D&eacute;cocher</a></span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" href="ajouter_motcle.php" role="button">Ajouter</a>
                                                        <input class="btn btn btn-danger" type="submit" name="Submit" value="Supprimer">
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td> <?php echo ($startRow_ss + 1) ?> &agrave; 
                                                        <?php echo min($startRow_ss + $maxRows_ss, $totalRows_ss) ?> sur 
                                                        <?php echo $totalRows_ss ?>
                                                    </td>
                                                    <td align="right"><a href="<?php printf("%s?pageNum_ss=%d%s", $currentPage, max(0, $pageNum_ss - 1), $queryString_ss); ?>">
                                                            <span class="glyphicon glyphicon-chevron-left"></span></a> | 
                                                        <a href="<?php printf("%s?pageNum_ss=%d%s", $currentPage, min($totalPages_ss, $pageNum_ss + 1), $queryString_ss); ?>">
                                                            <span class="glyphicon glyphicon-chevron-right"></span></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <p>
                                    <?php
                                    mysql_free_result($ss);
                                    ?>
                                </p>
                            </form>

                        </div>      
                    </div> 
                </div> 
            </div>
        </div>
        <script type="text/javascript" language="javascript">
            checkSelectValue();
        </script> 
    </body>
</html>