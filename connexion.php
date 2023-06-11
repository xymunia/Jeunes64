<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="connexion_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
</head>
<body>


<!--header de la page-->
<header> 
    <img src="images/jl.png" alt="logo" width="250" height="150">
    <div>
        <h1 id="gros_titre">VISITEUR</h1>
        <h1>Se connecter à son compte jeune</h1>
    </div>
</header>

<!-- barre de navigation en dessous du header -->
<div id="dv_nav">
    <ul id = "nav">
        <li id="li_nav1"><a href="connexion.php" id="a_nav1">JEUNE</a>
            <ul>
            <li class="souslien"><a href="connexion.php">CONNEXION</a></li>
            <li class="souslien"><a href="creation.php">INSCRIPTION</a></li>
            </ul>
        </li>
        <li id="li_nav2"><a href="" id="a_nav2">RÉFÉRENT</a></li>
        <li id="li_nav3"><a href="" id="a_nav3">CONSULTANT</a></li>
        <li id="li_nav4"><a href="partenaires.php" id="a_nav4">PARTENAIRES</a></li>
    </ul>
</div>

<form action = "" method = "post" style = "margin: 15% 0% 0% 25%;">
    <fieldset style = "border:none">
        <label for = "username">Utilisateur: </label>
        <input type = "text" name = "username" required>
        <br><br>
        <label for = "password">Mot de passe: </label>
        <input type = "password" name = "password" required>  
    </fieldset><br> 
    <input name="submit" type="submit" value="Connexion" id="submit"/>

    <?php 
        // on verifie si le compte existe deja
        if(isset($_SESSION['connecte']) && $_SESSION['connecte'] == false){
            echo "<p style=\"color:red\"> Le nom d'utilisateur ou le mot de est incorrect <p>";
            $_SESSION['connecte'] = true; // juste pour éviter que le message réapparaisse à chaque fois
        }
    ?>
</form>


<?php

  function Informations()
    {    

        if (isset($_POST['submit']))
        {
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['username'] = $_POST['username'];

            echo "<script> window.location.replace(\"verificationConnexion.php\");</script>";
        }
    }

    Informations();
?>


<!--
    commentaire 
-->

</body>
</html>