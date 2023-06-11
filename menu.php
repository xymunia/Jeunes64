<?php

    // on charge les fichiers nécessaires à l'utilisation de php mailer
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // on vérifier si l'utilisateur peut accéder à cette page
    session_start();
    if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] === false)
    {
        header("Location: description.php");
        die();
    }


    function disabled($article, $context)
    {
        if($article[1] == 0)    // si l'article n'est pas validé
        {
            if($context == 0) // si on cherche a disable la checkbox
            {
               echo "disabled";
            }
            else if($context == 1) // si on cherche a donner l'état de la demande
            {
                echo "<label style=\"color : grey\">en attente</label>";
            }
        }
        else if($context == 1) // si la demande est validé et que l'on cherche à donner l'état de la demande
        {
            echo "<label style=\"color : green\">validé</label>";
        }
    }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Jeune</title>
    <link rel="stylesheet" type="text/css" href="menu_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
    
    <script>
        // fonction pour faire apparaitre le formulaire pour envoyer au consultant
        function mail()
        {
            document.getElementById("dv_consultant").style.display = "inline-block";
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





<?php
    $file = fopen("demandes.csv", "r") or die("Ouverture du fichier demandes.csv impossible");

    $i = 0;

    // on fait une liste des demandes       id, valide, engagement, duree, nom, prenom, email 
    $articles = array();
    while(!feof($file)) 
    {
        // on met chaque ligne correspondant au compte dans articles (en prennant que les champs nécessaires)               0,2,8,9,13,14,16
        if($i!=0 && $data[1] == $_SESSION["id"])
        {
            $articles[$i] = [$data[0],$data[2],$data[8],$data[9],$data[13],$data[14],$data[16]];
        } 
        $line = fgets($file);
        $data = explode(',', $line);
        $i++;
    }

    fclose($file);
?>

<div id="main">
<br>

<form action="" method="post">
<!--on fait un div class=article par demande-->
<?php foreach($articles as $article):?>
<div class="article">
    <div class="left">
        <input type="checkbox" name="check_list[]" value="<?= $article[0]?>" <?= disabled($article,0)?>>
        <?= disabled($article,1)?>
    </div>
    <div class="right">
        <p>Engagement:<?=$article[2]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Durée:<?=$article[3]?></p>
        <p>Référent:<?=$article[4]?> &nbsp; <?=$article[5]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$article[6]?></p>
    </div>
</div>
<?php endforeach ?>


<input type="submit" name="submit_cv" value="Faire un livret d'expériences à partir des demandes sélectionnées" class="button">
<button type="button" onclick="mail()" class="button">Envoyer les demandes sélectionnées à un consultant</button>


<!--formulaire caché pour entrer les coordonnées du consultant-->
<div id="dv_consultant">
    <label for="consultant_mail">Adresse mail du consultant:</label>
    <input type="text" name="consultant_mail">
    <input type="submit" name="submit_mail" value="Envoyer" class="button" id="envoyer">
</div>
</form>
</div>

<?php
    // si le jeune appuie sur le bouton d'envoie du mail
    if(isset($_POST['submit_mail']))
    {
        if(!empty($_POST['check_list'])) // on verifie si il a bien validé au moins une checkbox
        {
            $ids = '';

            $i = 0;
            // on doit faire le lien de façon à retrouver tout les ids avec get
            foreach($_POST['check_list'] as $article) // on cherche à avoir un string de cette forme la: a[]=1&a[]=2&a[]=3
            {
                if($i==0)   // pour la 1ere iteration nous ne devons pas mettre un &
                {
                    $ids = $ids ."id[]=". $article[0];
                    $i=1;
                }
                else
                {
                    $ids = $ids ."&id[]=". $article[0];
                }
            }

            
            // on fait le lien et le message au consultant
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
                $mail->setFrom('projet.cytech@gmail.com', "");       
                $mail->addAddress($_POST["consultant_mail"], "");
                $mail->Subject = "Ce jeune souhaite vous présenter ses expériences !";
                $mail->Body = "Bonjour,\n Jeunes 6.4 est un site permettant la mise en valeur des expériences de la jeunesse.\n 
                Pour ce faire, les jeunes se font approuver leurs qualitées par le biais de référent pouvant faire valoir ces expériences.\n
                Une fois ses expériences validées, le jeune peut les envoyer à des consultants comme vous afin de se mettre en avant.\n
                Pour consulter les expériences que ce jeune vous partage, cliquez sur le lien suivant: http://localhost/Jeunes/jeune/consultant.php?id=".$ids;



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

                $message =  'Votre mail a été envoyé avec succès!';
            } 
            catch (Exception $e) {
                $message = "Il y a une erreur lors de l'envoi du mail. Veuillez réessayer.";
            }

            // envoie une alerte à l'utilisateur pour savoir si la validation a bien etait enregistre
            echo "<script type='text/javascript'>alert('".$message."');</script>";

            echo "<script> window.location.replace(\"menu.php\");</script>";
            
        }
    }

    // partie du code pour faire le pdf et html à partir des demandes sélectionner
    if(isset($_POST['submit_cv']))
    {
        if(!empty($_POST['check_list'])) // on verifie si le jeune a bien validé au moins une checkbox
        {


            // on ouvre le fichier csv contenant toutes les demandes
            $file = fopen("demandes.csv", "r") or die("Ouverture du fichier demandes.csv impossible");

            // on cherche toute les demandes que l'on doit écrire dans le livret
            $articles = array(); 
            $i = -1;
            while(!feof($file)) // on parcourt le fichier
            {
                
                if($i != -1) // $data n'existe pas à la 1 ere boucle donc pas besoin de comparer les id
                {
                    foreach($_POST['check_list'] as $id) // pour chaque demande validée
                    {
                        if($data[0] == $id) // si la ligne que l'on parcourt est une ligne que l'on veut utiliser dans le fichier html 
                        {
                            $articles[$i] = explode(',', $line);
                            $i++;
                        }
                    }
                }
                else
                {
                    $i = 0;
                }

                $line = fgets($file);
                $data = explode(',', $line);
            }

            fclose($file);

        
            // maintenant que nous avons la liste des demandes, on peut les écrires dans un fichier txt
            $file = fopen("livret.txt", "w") or die("Ouverture du fichier livret.txt impossible");

            // on fait le texte que nous allons écrire dans le fichier.txt
            foreach($articles as $article): // on met chaque demande dans le texte du fichier txt
                $line = "Jeune\nnom : $article[3] \n";
                $line .= "Prénom : $article[4] \n";
                $line .= "Date : $article[5] \n";
                $line .= "Email : $article[6] \n";
                $line .= "Réseau : $article[7] \n";
                $line .= "Engamennt : $article[8] \n";
                $line .= "Durée : $article[9] \n";
                $line .= "Savoir être : $article[10], $article[11], $article[12]\n\n";
                $line .= "Référent\nnom : $article[13]\n";
                $line .= "Prénom : $article[14] \n";
                $line .= "Date : $article[15] \n";
                $line .= "Email : $article[16] \n";
                $line .= "Présentation : $article[17] \n";
                $line .= "Durée : $article[18] \n";
                $line .= "Confirme ses savoirs faire: $article[19], $article[20], $article[21]\n";
                $line .= "Commentaire: $article[22]\n\n\n\n";

                // on écrit le contenu du fichier html
                fwrite($file,$line);
            endforeach;

           

            
            fclose($file);


            // on fait le texte à écrire dans le fichier html (c'est en grande partie du copier coller de consultant.php)
            $line='<!DOCTYPE html>
            <html lang="fr">
            <head>
                <title>Livret</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
                <style>
                html, body 
{
    margin: 0;
    padding: 0;
    height: 100%;
}

body
{
    height: 100%;
    overflow-x: hidden;  /*cache la barre déroulante qui va de gauche à droite */
}

#titre
{
    text-align: center;
    display: block;
    color: #00ACEF;
    font-size: 25px;
    font-family:\'Courier New\', Courier, monospace;
}




/*mise en page des formulaires*/



/*wrapper principal*/
#main
{
    width: 100%;
    background:
        radial-gradient(
            circle at bottom right,
            lightgrey,
            white 10%,
            transparent
        ),
        radial-gradient(
            circle at bottom left,
            lightgrey,
            white 10%,
            transparent
        );
    margin: 0;
    padding: 0;
    display: inline-block;
}

form
{
    width: 100%;
}

fieldset
{
    background-color: #ffffff;
    width: 85%;
}

h2
{
    padding: 0%;
    margin-top: 0%;
    font-size: xx-large;
    font-family: Arial, Helvetica, sans-serif;
}

input[type=text], input[type=email] {
    border: none;
    border-bottom: 2px dotted palevioletred;
    width: auto;
    font-family:MV Boli,cursive;
    color: blue;
    font-size: .78em;
}

h3
{
    background-color: lightgreen;
    background-color: green;
    background-image:
    linear-gradient(
        to right, 
        white, 
        #F35DB5 40%,
        #EC018C
        );
    color: white;
    text-align: right;
    font-size: 20px;
    font-family:\'Trebuchet MS\', \'Lucida Sans Unicode\', \'Lucida Grande\', \'Lucida Sans\', Arial, sans-serif;
    font-weight: 100;
    padding: 3%;
    padding-left: 7%;
    margin: 0%;
}

legend
{
    text-align: center;
    font-family:\'Courier New\', Courier, monospace;
    font-weight: bold;
}

.wrapper_article
{
    width: 100%;
    display: inline-flex;
    padding-left: 10%;
}

.field
{
    margin: 0;
    padding: 0;
    display: inline-flex;

    padding-left: 2%;
    padding-top:1%
}

.center
{
    padding-left: 0%;
    margin: 0%;
    width: 78%;

    font-size: 20px;
    font-family:\'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif
}

.wrapper_left
{
    width: 43%;
}

.left_field
{
    border-color: #EC018C;
    color: #EC018C;
}

.left_check
{
    background-image:
        radial-gradient(
        circle at top left,
        #FDF6FB,
        #FDEDF7 50%
        );
}

.wrapper_right
{
    width: 43%;
}

.right_field
{
    border-color: #B5D46F;
    color: #B5D46F;
}

.right_field input[type=text], .right_field input[type=email]
{
    border-color: #B5D46F;
}

.right_field h3
{
    background: linear-gradient(
        to right,
            #D5E260,
            #45BB3A 80%
        );
}

.petit_titre
{
    font-size: 14px;
}




.dv_check
{
    width: 31%;
}

.field_checkbox
{
    border : 0;
    margin: 0 auto;
    padding: 0%;
    display: inline-block;
    width: 95%;
}

.dv_checkbox
{
    color: black;
}

.right_check
{
    background-image:
        radial-gradient(
        circle at top left,
            #e5f270,
            #a5fB9A 80%
        );
}

label
{
    display: inline-block;
}

.right
{
    margin: 0 auto;
    padding-left: 20%;
    width: 100%;
}

.dv_commentaire
{
    background-image:
    radial-gradient(
        circle at top left,
            #e5f260, 
            #e5eaa0 50%
        );
    margin-left: 54%;
    margin-right: 10%;
    padding: 1%
}

.titre_commentaire
{
    font-size: 25px;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
}

.commentaire
{
    resize: none; /*pour empêcher le textarea de pouvoir se faire resize*/
    border: none;
    font-family:MV Boli,cursive;
    color: blue;
    font-size: 15px;
    margin: 0;
}
                </style>
            </head>
            <body>
            <div id="main">
            <form action=""><br><br><br><br>';

            foreach($articles as $article): // on met chaque demande dans le fichier html
                $line = $line.'
                <div class="wrapper_article">
                    <div id="wrapper_left">
                    <fieldset class="left_field field" disabled>
                    <!--formulaire textuelle au milieu-->
                    <div class="center left_center">
                        <h2 class="titre_jeune">JEUNE</h2>
                        
                                <label>NOM :</label>
                                <input type="text" class="nom" id="left_nom" name="nom" value="'.$article[3].'" readonly><br>

                                <label>PRENOM :</label>
                                <input type="text" class="prenom" id="left_prenom" name="prenom" value="'.$article[4].'"readonly><br>

                                <label>DATE DE NAISSANCE :</label>
                                <input type="text" class="date" id="left_date" name="date" value="'.$article[5].'" readonly><br>

                                <label>Mail :</label>
                                <input type="email" class="email" id="left_email" name="email" value="'.$article[6].'" readonly><br>

                                <label>Réseau social :</label>
                                <input type="text" class="reseau" id="left_reseau" name="reseau" value="'.$article[7].'" readonly><br>
                                <br>
                                <label>MON ENGAGEMENT :</label>
                                <input type="text" class="engagement" id="left_engagement" name="engagement" value="'.$article[8].'" readonly><br>

                                <label>DUREE :</label>
                                <input type="text" class="duree" id="right_duree" name="duree" value="'.$article[9].'" readonly><br><br>
                            </div>  
                            
                            <!--formulaire checkbox sur la droite-->
                            <div class="dv_check">
                                <fieldset class="field_checkbox" disabled>
                                    <legend>Mes savoir etre</legend>
                                    <div class="dv_checkbox left_check">
                                        <h3> Je suis*</h3>
                                        <div>
                                            <input type="checkbox" class="check" name="'.$article[10].'" checked readonly>
                                            <label>'.$article[10].'</label><br>
                                            <input type="checkbox" class="check" name="'.$article[11].'" checked readonly>
                                            <label>'.$article[11].'</label><br>
                                            <input type="checkbox" class="check" name="'.$article[12].'" checked readonly>
                                            <label>'.$article[12].'</label>
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
                                <input type="text" class="nom" id="right_nom" name="nom" value="'.$article[13].'" readonly><br>

                                <label>PRENOM :</label>
                                <input type="text" class="prenom" id="right_prenom" name="prenom" value="'.$article[14].'" readonly><br>

                                <label>DATE DE NAISSANCE :</label>
                                <input type="text" class="date" id="right_date" name="date" value="'.$article[15].'" readonly><br>

                                <label>Mail :</label>
                                <input type="email" class="email" id="right_email" name="email" value="'.$article[16].'" readonly><br>
                                <br>
                                <label>Présentation :</label>
                                <input type="text" class="engagement" id="right_engagement" name="engagement" value="'.$article[17].'" readonly><br>

                                <label>DUREE :</label>
                                <input type="text" class="duree" id="right_duree" name="duree" value="'.$article[18].'" readonly><br><br>
                            </div>  
                    
                            <!--formulaire checkbox sur la droite-->
                            <div class="dv_check">
                                <fieldset class="field_checkbox" class="right_field_checkbox" disabled>
                                    <legend>Ses savoir etre</legend>
                                    <div class="dv_checkbox right_check">
                                        <h3 class="petit_titre"> Je confirme sa(son)*</h3>
                                        <div>
                                            <input type="checkbox" class="check" id="'.$article[19].'" checked readonly>
                                            <label>'.$article[19].'</label><br>
                                            <input type="checkbox" class="check" id="'.$article[20].'" checked readonly>
                                            <label>'.$article[20].'</label><br>
                                            <input type="checkbox" class="check" id="'.$article[21].'" checked readonly>
                                            <label>'.$article[21].'</label>
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
                            <p class="commentaire">'.$article[22].'</p>
                        </div>
                        
                        <br><br>
                        <br>
                        <br>
                        <br>';

            endforeach;
            $line=$line.'</form></div></body></html>';


            // maintenant que nous avons la liste des demandes, on peut les écrires dans un fichier html
            $file = fopen("livret.html", "w") or die("Ouverture du fichier livret.html impossible");

            // on écrit le contenu du fichier html
            fwrite($file,$line);
            fclose($file);


            // on fait les liens de téléchargement pour les fichiers html et txt
            echo "<a href=\"livret.txt\" download>Télécharger le fichier en txt</a><br><br>";
            echo "<a href=\"livret.html\" download>Télécharger le fichier en html</a>";
       }
    }

?>
</body>
</html>