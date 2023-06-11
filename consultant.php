<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Consultant</title>
    <link rel="stylesheet" type="text/css" href="consultant_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>

</head>
<body>

<!--header de la page-->
<header> 
    <div>
        <img src="images/jl.png" alt="logo" width="250" height="150">
        <div>
            <h1 id="gros_titre">CONSULTANT</h1>
            <h1>Je donne de la valeur à ton engagement</h1>
        </div>
    </div>

    <br>

    <!-- barre de navigation en dessous du header -->
    <div id="dv_nav">
        <ul id = "nav">
            <li id="li_nav1"><a href="" id="a_nav1">JEUNE</a></li>
            <li id="li_nav2"><a href="" id="a_nav2">RÉFÉRENT</a></li>
            <li id="li_nav3"><a href="" id="a_nav3">CONSULTANT</a></li>
            <li id="li_nav4"><a href="partenaires.php" id="a_nav4">PARTENAIRES</a></li>
        </ul>
    </div>
</header>

<br>
<br>
<br>
<br>
<strong id="titre">Validez cet engagement en prenant en compte sa valeur</strong>

<br>

<?php
    // on va chercher chaque demande à afficher

    // on ouvre le fichier csv contenant toutes les demandes
    $file = fopen("demandes.csv", "r") or die("Ouverture du fichier demandes.csv impossible");
    $i = 0;

    // on fait une liste des demandes nécessaires avec chaque champs
    $articles = array();
    while(!feof($file))
    {
        // on prend chaque ligne avec un id correspondant à un id present dans $_get["id"]   $j parcourt get, $i parcourt les lignes du fichier
        for ($j = 0; $j < count($_GET["id"]); $j++) 
        {    
            if($i!=0 && $data[0] == $_GET["id"][$j])
            {
                $articles[$i] = explode(',', $line);
            }
        } 
        $line = fgets($file);
        $data = explode(',', $line);
        $i++;
    }

    fclose($file);
?>





<div id="main">
<form action="">

<?php
// on va répéter le schéma des formulaires pour chaque demande validée
    foreach($articles as $article):
        ?>
    <div class="wrapper_article">
        <div class="wrapper_left">
            <fieldset class="left_field field" disabled>
                <!--formulaire textuelle au milieu-->
                <div class="center left_center">
                    <h2 class="titre_jeune">JEUNE</h2>

                    <label>NOM :</label>
                    <input type="text" class="nom" class="left_nom" name="nom" value="<?=$article[3]?>" readonly><br>

                    <label>PRENOM :</label>
                    <input type="text" class="prenom" class="left_prenom" name="prenom" value="<?=$article[4]?>"readonly><br>

                    <label>DATE DE NAISSANCE :</label>
                    <input type="text" class="date" class="left_date" name="date" value="<?=$article[5]?>" readonly><br>

                    <label>Mail :</label>
                    <input type="email" class="email" class="left_email" name="email" value="<?=$article[6]?>" readonly><br>

                    <label>Réseau social :</label>
                    <input type="text" class="reseau" class="left_reseau" name="reseau" value="<?=$article[7]?>" readonly><br>
                    <br>
                    <label>MON ENGAGEMENT :</label>
                    <input type="text" class="engagement" class="left_engagement" name="engagement" value="<?=$article[8]?>" readonly><br>

                    <label>DUREE :</label>
                    <input type="text" class="duree" class="left_duree" name="duree" value="<?=$article[9]?>" readonly><br><br>
                </div>  
                
                <!--formulaire checkbox sur la droite-->
                <div class="dv_check">
                    <fieldset class="field_checkbox" disabled>
                        <legend>Mes savoir etre</legend>
                        <div class="dv_checkbox left_check">
                            <h3> Je suis*</h3>
                            <div>
                                <input type="checkbox" class="check" name="<?=$article[10]?>" checked readonly>
                                <label><?=$article[10]?></label><br>
                                <input type="checkbox" class="check" name="<?=$article[11]?>" checked readonly>
                                <label><?=$article[11]?></label><br>
                                <input type="checkbox" class="check" name="<?=$article[12]?>" checked readonly>
                                <label><?=$article[12]?></label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                
            </fieldset>
        </div>

        <div class="wrapper_right">
            <fieldset class="right_field field" disabled>
                
                <!--formulaire textuelle au milieu-->
                <div class="center right_center">
                    <h2 class="titre_referent">RÉFÉRENT</h2>

                    <label>NOM :</label>
                    <input type="text" class="nom" class="right_nom" name="nom" value="<?=$article[12]?>" readonly><br>

                    <label>PRENOM :</label>
                    <input type="text" class="prenom" class="right_prenom" name="prenom" value="<?=$article[13]?>" readonly><br>

                    <label>DATE DE NAISSANCE :</label>
                    <input type="text" class="date" class="right_date" name="date" value="<?=$article[14]?>" readonly><br>

                    <label>Mail :</label>
                    <input type="email" class="email" class="right_email" name="email" value="<?=$article[15]?>" readonly><br>

                    <label>Réseau social :</label>
                    <input type="text" class="reseau" class="right_reseau" name="reseau" value="<?=$article[16]?>" readonly><br>
                    <br>
                    <label>Présentation :</label>
                    <input type="text" class="engagement" class="right_engagement" name="engagement" value="<?=$article[17]?>" readonly><br>

                    <label>DUREE :</label>
                    <input type="text" class="duree" class="right_duree" name="duree" value="<?=$article[18]?>" readonly><br><br>
                </div>   
        
                <!--formulaire checkbox sur la droite-->
                <div class="dv_check">
                    <fieldset class="field_checkbox" class="right_field_checkbox" disabled>
                        <legend>Ses savoir etre</legend>
                        <div class="dv_checkbox right_check">
                            <h3 class="petit_titre"> Je confirme sa(son)*</h3>
                            <div>
                                <input type="checkbox" class="check" name="<?=$article[19]?>" checked readonly>
                                <label><?=$article[19]?></label><br>
                                <input type="checkbox" class="check" name="<?=$article[20]?>" checked readonly>
                                <label><?=$article[20]?></label><br>
                                <input type="checkbox" class="check" name="<?=$article[21]?>" checked readonly>
                                <label><?=$article[21]?></label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </fieldset>
        </div>    

    </div>

    <br>
    <br>
    <div class="dv_commentaire">
        <h5 class="titre_commentaire">COMMENTAIRE:</h5>
        <p class="commentaire"><?=$article[22]?></p>
    </div>
    
    <br><br>
    <br>
    <br>
    <br>
    
    <?php
    endforeach;
?>
</form>
</div>


</body>
</html>
