<?php
    // on charge les fichiers nécessaires à l'utilisation de php mailer
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] === false)
    {
        header("Location: description.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Demande</title>
    <link rel="stylesheet" type="text/css" href="demande_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
    
    <script>
        //fonction pour changer de formulaire à remplir
        function changement()
        {
            document.getElementById("main1").style.display = "none";
            document.getElementById("main2").style.display = "flex";

            document.getElementById("titre1").style.display = "none";
            document.getElementById("titre2").style.display = "block";

            return false;
        }
    </script>
</head>
<body>

<header> 
    <div>
        <img src="images/jl.png" alt="logo" width="250" height="150">
        <div>
            <h1 id="gros_titre">JEUNE</h1>
            <h1>Je donne de la valeur à mon engagement</h1>
        </div>
    </div>    

    <br>

    <!-- barre de navigation-->
    <div id="dv_nav">
        <ul id = "nav">
            <li id="li_nav1"><a href="menu.php" id="a_nav1">JEUNE</a>
                <ul>
                    <li class="souslien"><a href="profil.php">PROFIL</a></li>
                    <li class="souslien"><a href="menu.php">MENU</a></li>
                    <li class="souslien"><a href="demande.php">DEMANDE</a></li>
                    <li class="souslien"><a href="deconnexion.php">DECONNEXION</a></li>
                </ul>
            </li>
            <li id="li_nav2"><a href="" id="a_nav2">RÉFÉRENT</a></li>
            <li id="li_nav3"><a href="" id="a_nav3">CONSULTANT</a></li>
            <li id="li_nav4"><a href="" id="a_nav4">PARTENAIRES</a></li>
        </ul>
    </div>
</header>

<br>
<br>
<br>
<br>


<strong id="titre1" class="titre">Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</strong>


<strong id="titre2" class="titre">
<br>
<br>
<br>Indiquez une personne pour valider votre expérience.
</strong>


<!--formulaires comprenant à la fois le formulaire de la demande du jeune et le formulaire des coordonnees du referent-->
<div id="main">
<form action="" method="post">

    <!--formulaire du jeune-->
    <div id="main1" class="dv_form">

        <!--partie du formulaire avec les champs textuelle au milieu-->
        <div class="center">
            <fieldset class="text_field">
                <label for="nom_jeune">NOM :</label>
                <input type="text" id="nom_jeune" name="nom_jeune" required><br>

                <label for="prenom_jeune">PRENOM :</label>
                <input type="text" id="prenom_jeune" name="prenom_jeune" required><br>

                <label for="date_jeune">DATE DE NAISSANCE :</label>
                <input type="text" id="date_jeune" name="date_jeune" required><br>

                <label for="email_jeune">Mail :</label>
                <input type="email" id="email_jeune" name="email_jeune" required><br>

                <label for="reseau_jeune">Réseau social :</label>
                <input type="text" id="reseau_jeune" name="reseau_jeune"><br>
                <br>
                <label for="engagement_jeune">MON ENGAGEMENT :</label>
                <input type="text" id="engagement_jeune" name="engagement_jeune"><br>

                <label for="duree_jeune">DUREE :</label>
                <input type="text" id="duree_jeune" name="duree_jeune"><br><br>
            </fieldset>
        </div>  
    
        <!--partie du formulaire avec les checkbox sur la droite-->
        <div class="right">
            <fieldset class="field_checkbox">
                <legend>MES SAVOIRS ETRE</legend>
                
                <h2> Je suis*</h2>
                <div class="dv_checkbox">
                    <div>
                        <input type="checkbox" value="autonome" name="check_list[]">
                        <label>Autonome</label>
                    </div>
                
                    <div>
                        <input type="checkbox" value="passionne" name="check_list[]">
                        <label>Passionné</label>
                    </div>

                    <div>
                        <input type="checkbox" value="ecoute" name="check_list[]">
                        <label>A l'écoute</label>
                    </div>

                    <div>
                        <input type="checkbox" value="organise" name="check_list[]">
                        <label>Organisé</label>
                    </div>

                    <div>
                        <input type="checkbox" value="passionne" name="check_list[]">
                        <label>Passionné</label>
                    </div>

                    <div>
                        <input type="checkbox" value="fiable" name="check_list[]">
                        <label>Fiable</label>
                    </div>

                    <div>
                        <input type="checkbox" value="patient" name="check_list[]">
                        <label>Patient</label>
                    </div>

                    <div>
                        <input type="checkbox" value="reflechi" name="check_list[]">
                        <label>Réfléchi</label>
                    </div>

                    <div>
                        <input type="checkbox" value="responsable" name="check_list[]">
                        <label>Responsable</label>
                    </div>

                    <div>
                        <input type="checkbox" value="sociable" name="check_list[]">
                        <label>Sociable</label>
                    </div>
                
                    <div>
                        <input type="checkbox" value="optimiste" name="check_list[]">
                        <label>Optimiste</label>
                    </div>
                </div>
                <p><small>*Faire 3 choix</small></p>
            </fieldset>
            <br>
            <button onclick="changement()" class="submit">Valider</button>
        </div>
    </div>


    <br>


    <!--formulaire des coordonnees du referent-->
    <div id="main2" class="dv_form">

        <!--partie du formulaire avec les champs textuelle au milieu-->
        <div id="center">
            <fieldset class="text_field">
                <label for="nom">NOM :</label>
                <input type="text" id="nom" name="nom" required><br>

                <label for="prenom">PRENOM :</label>
                <input type="text" id="prenom" name="prenom" required><br>

                <label for="date">DATE DE NAISSANCE :</label>
                <input type="text" id="date" name="date" required><br>

                <label for="email">Mail :</label>
                <input type="email" id="email" name="email" required><br>
            </fieldset>

            <input id="submit" class="submit" type="submit" name="submitbutton" value="Confirmer">
        </div>
    </div>

</form>
</div>

</body>
</html>



<?php

    if (isset($_POST['submitbutton']))
    {
        if (isset($_POST['check_list']) && count($_POST['check_list']) == 3) 
        {
            // on ouvre le fichier csv contenant toutes les demandes
            $file = fopen("demandes.csv", "r+") or die("Ouverture du fichier demandes.csv impossible");

            $id = 1000;

            // on parcours tout les id pour avoir un nouvel id a associé à la demande
            while(!feof($file)) 
            {
                $line = fgets($file);
                $id++;
            }

            // on choisi un id qui n'a pas encore était associé à une demande
            $id++;


            // on doit envoyer le lien à l'adresse mail du référent


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
                $mail->setFrom('projet.cytech@gmail.com', $_POST["nom_jeune"]." ".$_POST["prenom_jeune"]);       
                $mail->addAddress($_POST["email"], $_POST["nom"]." ".$_POST["prenom"]);
                $mail->Subject = $_POST["nom_jeune"]." ".$_POST["prenom_jeune"].' vous demande un service!';
                $mail->Body = 'Bonjour '.$_POST["nom"]." ".$_POST["prenom"]."!\n Jeunes 6.4 est un site permettant la mise en valeur des expériences de la jeunesse.\n 
                Pour ce faire, les jeunes ont besoin de personnes pouvant attester leurs qualitées.\n\n Ainsi,".$_POST["nom_jeune"]." ".$_POST["prenom_jeune"]." vous a choisi pour que vous validiez son expérience.
                Rendez-vous sur le lien ci-dessous pour l'aider à se mettre en valeur ! \nhttp://localhost/Jeunes/jeune/validation.php?id=".$id;
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
        
                $message = 'Votre demande a été envoyé avec succès!';

                // on doit enregistrer les champs des formulaires dans les fichiers csv correspondant
                

                // on écrit la demande dans le fichier csv en spécifiant tout les champs
                //id, id du compte, si validé ou non, champs du jeune, champs du referent
                $line1 = $id.",".$_SESSION["id"].",0,".$_POST["nom_jeune"].",".$_POST["prenom_jeune"].",".$_POST["date_jeune"].",";
                $line2 = $_POST["email_jeune"].",".$_POST["reseau_jeune"].",".$_POST["engagement_jeune"].",".$_POST["duree_jeune"].",";
                $line3 = implode(",",$_POST["check_list"]).",";
                $line4 = $_POST["nom"].",".$_POST["prenom"].",".$_POST["date"].",".$_POST["email"]."\n";

                $txt = $line1.$line2.$line3.$line4;
                fwrite($file, $txt);
            } 
            catch (Exception $e) {
                $message = 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
            }

            fclose($file);
        }
        else
        {
            $message = "Vous n'avez pas sélectionnées 3 savoir-être. Veuillez rééssayez";
        }
        
        $_SESSION["message"]=$message;

        // envoie une alerte à l'utilisateur pour savoir si la demande a bien était enregistré
        echo "<script>alert(\"$message."\");</script>";

        echo "<script> window.location.replace(\"menu.php\");</script>";
        
    }
?>