<?php

    // on charge les fichiers nécessaires à l'utilisation de php mailer
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // on va chercher chaque demande à afficher

    // on ouvre le fichier csv contenant toutes les demandes
    $file = fopen("demandes.csv", "r") or die("Ouverture du fichier demandes.csv impossible");
    $i = 0;

    // on fait une liste des demandes nécessaires avec chaque champs
    while(!feof($file))
    {
        // on prend la ligne correspondant à l'id de la demande que l'on souhaite valider
  
        if($i != 0 && $data[0] == $_GET["id"]) // data existe pas à la 1ere boucle donc on met une condition pour ne pas faire d'erreur
        {
            $article = explode(',', $line);
        }

        $line = fgets($file);
        $data = explode(',', $line);

        $i++;
    }

    fclose($file);

    if($article[2]=="1")
    {
        header("Location: merci.php");
        die();
    }

?>



<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Validation</title>
    <link rel="stylesheet" type="text/css" href="validation_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
    
    <script>
        //fonction pour changer de formulaire à remplir
        function changement()
        {
            document.getElementById("main1").style.display = "none";
            document.getElementById("main2").style.display = "flex";
            // sur cette page en particulier, le button réactualise la page empêchant le changement de formulaire, return false résout ce problème
            return false;
        }
    </script>
</head>
<body>

<!--header de la page-->
<header> 
    <div>
        <img src="images/jl.png" alt="logo" width="250" height="150">
        <div>
            <h1 id="gros_titre">RÉFÉRENT</h1>
            <h1>Je confirme la valeur de ton engagement</h1>
        </div>
    </div>    

    <br>

    <!-- barre de navigation-->
    <div id="dv_nav">
        <ul id = "nav">
            <li id="li_nav1"><a href="connexion.php" id="a_nav1">JEUNE</a></li>
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

<strong class="titre">Validez cet engagement en prenant en compte sa valeur.</strong>

<!--formulaire du jeune-->
<div id="main">
<form method="post" action="">


    <!--formulaire du jeune-->
    <div id="main1" class="dv_form">

        <!--partie du formulaire avec les champs textuelle au milieu-->
        <div class="center">
            <fieldset class="text_field">
                <label for="nom_jeune">NOM :</label>
                <input type="text" id="nom_jeune" name="nom_jeune" value="<?=$article[3]?>" required><br>

                <label for="prenom_jeune">PRENOM :</label>
                <input type="text" id="prenom_jeune" name="prenom_jeune" value="<?=$article[4]?>" required><br>

                <label for="date_jeune">DATE DE NAISSANCE :</label>
                <input type="text" id="date_jeune" name="date_jeune" value="<?=$article[5]?>" required><br>

                <label for="email_jeune">Mail :</label>
                <input type="email" id="email_jeune" name="email_jeune" value="<?=$article[6]?>" required><br>

                <label for="reseau_jeune">Réseau social :</label>
                <input type="text" id="reseau_jeune" name="reseau_jeune" value="<?=$article[7]?>"><br>
                <br>
                <label for="engagement_jeune">MON ENGAGEMENT :</label>
                <input type="text" id="engagement_jeune" name="engagement_jeune" value="<?=$article[8]?>"><br>

                <label for="duree_jeune">DUREE :</label>
                <input type="text" id="duree_jeune" name="duree_jeune" value="<?=$article[9]?>"><br><br>
            </fieldset>
        </div>  

        <!--partie du formulaire avec les checkbox sur la droite-->
        <div class="right">
            <fieldset class="field_checkbox">
                <legend>MES SAVOIR-ÊTRE</legend>
                <h2 style="font-size:xx-large;"> Je suis*</h2>
                <div class="dv_checkbox">
                    <div>
                        <label for="<?=$article[10]?>"><?=$article[10]?></label>
                        <input type="checkbox" value="<?=$article[10]?>" id="<?=$article[10]?>" name="check_list[]" onclick="return false" checked>
                    </div>
                
                    <div>
                        <label for="<?=$article[11]?>"><?=$article[11]?></label>
                        <input type="checkbox" value="<?=$article[11]?>" id="<?=$article[11]?>"  name="check_list[]" onclick="return false" checked>
                    </div>

                    <div>
                        <label for="<?=$article[12]?>"><?=$article[12]?></label>
                        <input type="checkbox" value="<?=$article[12]?>" id="<?=$article[12]?>"  name="check_list[]" onclick="return false" checked>
                    </div>
                </div>
                <p><small>*Faire 3 choix</small></p>
            </fieldset>
            <button onclick="return changement()" class="submit">Valider</button>
        </div>
    </div>




    <!--formulaire des coordonnees du referent-->
    <div id="main2" class="dv_form">

        <!--partie du formulaire pour mettre un commentaire-->
        <div id="left">
            <h2 id="titre_commentaire"> COMMENTAIRES</h2>
            <div id="dv_commentaire">
                <textarea name="commentaire" id="commentaire" cols="30" rows="17"></textarea>
            </div>

        </div>

        <!--partie du formulaire avec les champs textuelle au milieu-->
        <div class="center" id="center">
            <fieldset class="text_field">
                <label for="nom">NOM :</label>
                <input type="text" id="nom" name="nom" value="<?=$article[13]?>" required><br>

                <label for="prenom">PRENOM :</label>
                <input type="text" id="prenom" name="prenom" value="<?=$article[14]?>" required><br>

                <label for="date">DATE DE NAISSANCE :</label>
                <input type="text" id="date" name="date" value="<?=$article[15]?>" required><br>

                <label for="email">Mail :</label>
                <input type="email" id="email" name="email" value="<?=$article[16]?>" required><br>
                <br>

                <label for="presentation">PRÉSENTATION  :</label>
                <input type="text" id="presentation" name="presentation"><br>

                <label for="duree">DUREE :</label>
                <input type="text" id="duree" name="duree"><br><br>
            </fieldset>
        </div>   

        <!--formulaire checkbox sur la droite-->
        <div class="right" id="right">
            <fieldset class="field_checkbox">
                <legend>Ses savoir etre</legend>
                <h2> Je confirme sa(son)*</h2>
                <div class="dv_checkbox">
                    <div>
                        <input type="checkbox" id="autonome" value="autonome" name="ref_list[]">
                        <label for="autonome">Autonome</label>
                    </div>
                    
                    <div>
                        <input type="checkbox" id="passionne" value="passionne" name="ref_list[]">
                        <label for="passionne">Passionné</label>
                    </div>

                    <div>
                        <input type="checkbox" id="ecoute" value="ecoute" name="ref_list[]">
                        <label for="ecoute">A l'écoute</label>
                    </div>

                    <div>
                        <input type="checkbox" id="organise" value="organise" name="ref_list[]">
                        <label for="organise">Organisé</label>
                    </div>

                    <div>
                        <input type="checkbox" id="passionne" value="passionne" name="ref_list[]">
                        <label for="passionne">Passionné</label>
                    </div>

                    <div>
                        <input type="checkbox" id="fiable" value="fiable" name="ref_list[]">
                        <label for="fiable">Fiable</label>
                    </div>

                    <div>
                        <input type="checkbox" id="patient" value="patient" name="ref_list[]">
                        <label for="patient">Patient</label>
                    </div>

                    <div>
                        <input type="checkbox" id="reflechi" value="reflechi" name="ref_list[]">
                        <label for="reflechi">Réfléchi</label>
                    </div>

                    <div>
                        <input type="checkbox" id="responsable" value="responsable" name="ref_list[]">
                        <label for="responsable">Responsable</label>
                    </div>

                    <div>
                        <input type="checkbox" id="sociable" value="sociable" name="ref_list[]">
                        <label for="sociable">Sociable</label>
                    </div>
                
                    <div>
                        <input type="checkbox" id="optimiste" value="optimiste" name="ref_list[]">
                        <label for="optimiste">Optimiste</label>
                    </div>
                </div>
                <p><small>*Faire 3 choix</small></p>
            </fieldset>
            <input id="submit" type="submit" name="submit" class="submit" value="Valider">
        </div>

    </div>
 
</form>
</div>


<?php

    if (isset($_POST['submit']))
    {
        if (isset($_POST['ref_list']) && count($_POST['ref_list']) == 3) 
        {

            // on ouvre le fichier en écriture et en lecture
            $reading = fopen('demandes.csv', 'r') or die("Ouverture du fichier demandes.csv impossible");
            $writing = fopen('myfile.tmp', 'w');

            $replaced = false;

            // on écrit chaque ligne sauf lorsque l'on tombe sur la ligne de la demande que l'on remplace par les nouveaux champs
            while (!feof($reading)) {
                $line = fgets($reading);
                if (stristr($line, $_GET["id"])) 
                {
                    // on écrit la demande dans le fichier tmp en spécifiant tout les champs
                    //id, id du compte, si validé ou non, champs du jeune, champs du referent
                    $line1 = $article[0].",".$article[1].",1,".$_POST["nom_jeune"].",".$_POST["prenom_jeune"].",".$_POST["date_jeune"].",";
                    $line2 = $_POST["email_jeune"].",".$_POST["reseau_jeune"].",".$_POST["engagement_jeune"].",".$_POST["duree_jeune"].",";
                    $line3 = implode(",",$_POST["check_list"]).",";
                    $line4 = $_POST["nom"].",".$_POST["prenom"].",".$_POST["date"].",".$_POST["email"].",".$_POST["presentation"].",".$_POST["duree"].",";
                    $line5 = implode(",",$_POST["ref_list"]).",".$_POST["commentaire"]."\n";
                    
                    $line = $line1.$line2.$line3.$line4.$line5;

                    $replaced = true;
                }

                fputs($writing, $line);
            }
            fclose($reading); 
            fclose($writing);

            // on change l'ancien fichier par le nouveau
            if ($replaced) 
            {
                rename('myfile.tmp', 'demandes.csv');
            } 
            else {
                unlink('myfile.tmp');
            }



            // Instanciation de PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Instanciation de PHPMailer
                $mail = new PHPMailer(true);

                // Paramètres du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'projet.cytech@gmail.com';
                $mail->Password = 'ssudddrfmazlkfto';
                $mail->SMTPSecure = 'tls';
            
                // Paramètres de l'e-mail
                $mail->setFrom('projet.cytech@gmail.com', $_POST["nom"]." ".$_POST["prenom"]);       
                $mail->addAddress($_POST["email_jeune"], $_POST["nom_jeune"]." ".$_POST["prenom_jeune"]);
                $mail->Subject = $_POST["nom"]." ".$_POST["prenom"].' a validé votre demande!';
                $mail->Body = 'Bonjour '.$_POST["nom_jeune"]." ".$_POST["prenom_jeune"]."!\n 
                Il semblerait que ".$_POST["nom"]." ".$_POST["prenom"]." ait validé votre demande.\n
                Retournez sur le site pour vous en assurer: https://localhost/jeunes/jeune/menu.php";
                $mail->CharSet = 'UTF-8';
                
                // Désactiver la vérification du certificat SSL
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );
                $mail->send();  

                $message = 'Votre validation a bien était prise en compte!';
                $link = "merci.php";
            } 
            catch (Exception $e) {
                $message = "Impossible de valider la demande. Veuillez réessayer.";
                $link = "validation.php?id=\"".$_GET["id"]."\"";
            }
        }
        else
        {
            $message = "Vous n'avez pas sélectionnées 3 savoir-être. Veuillez rééssayez";
            $link = "validation.php?id=\"".$_GET["id"]."\"";           
        }

        // envoie une alerte à l'utilisateur pour savoir si la demande a bien était enregistré
        echo "<script>window.alert(\"".$message."\");</script>";

        // redirige l'utilisateur au bon endroit
        echo "<script> window.location.replace(\"".$link."\");</script>";

    }
    
?>

</body>
</html>