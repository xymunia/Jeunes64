<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Creation</title>
    <link rel="stylesheet" type="text/css" href="creation_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
</head>
<body>


<!--header de la page-->
<header> 
    <img src="images/jl.png" alt="logo" width="250" height="150">
    <div>
        <h1 id="gros_titre">VISITEUR</h1>
        <h1>S'inscrire en tant que jeune</h1>
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




<!--formulaire de creation de compte-->
<form action = "" method = "post" style = "margin: 15% 0% 0% 25%;">
    <fieldset style = "border:none">
        <label for = "nom">Pseudonyme: </label>
        <input type = "text" name = "username" required>
        <br><br>
        <label for = "password">Mot de passe: </label>
        <input type = "password" name = "password" required>
        <?php 
        // on verifie si le compte existe deja
        if(isset($_SESSION['existe']) && $_SESSION['existe'] == true)
        {
            echo "<p style=\"color:red\"> Ce compte existe déjà <p>";
            $_SESSION['existe'] = false;
        }
        ?>  
    </fieldset><br> 
    <input name="submit" type="submit" value="Création" id="submit"/>
</form>

<?php

    if (isset($_POST['submit']))
    {

        // on met les parametres du comptes comme parametres de la session (on se connecte des que l'on a cree le compte) 
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['username'] = $_POST['username'];

        echo "<p>".$_POST['username']." === ".$_POST['password'];
        echo "<br>".$_SESSION['username']." === ".$_SESSION['password'];
        echo "</p>";

        echo "<script> window.location.assign(\"verificationCreation.php\");;</script>";
    }
    
?>


<!--
    commentaire 
-->

</body>
</html>