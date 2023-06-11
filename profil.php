<?php 
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
	<title>Jeune</title>
    <link rel="stylesheet" type="text/css" href="profil_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
    
    <script>
        //fonction pour rendre les champs du profil modifiable
        function modiferProfil()
        {
            // on rend les informations du formulaires modifiables, on cache le bouton et on montre le submit
            document.getElementById("profil").disabled = false;
            document.getElementById("cache").style.display = "block";
            document.getElementById("pas_cache").style.display = "none";

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

<br>
<br>
<br>


<div id="main">
<form action="" method="post">
    <fieldset id="profil" disabled>
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" value="<?=$_SESSION["username"]?>"/>
        <br>
        <br>
        <label for="username">Mot de passe:</label>
        <input type="text" name="password" value="<?=$_SESSION["password"]?>"/>
    </fieldset>
    <input type="submit" name="submit" value="Valider" id="cache" class="button">
    <input type="button" name="edit" value="Modifier le profil" onclick="modiferProfil()" id="pas_cache" class="button">
</form>
</div>


<?php
    if(isset($_POST['submit'])) // on change les informations dans le csv
    {
        // on ouvre le fichier en écriture et en lecture
        $reading = fopen('comptes.csv', 'r') or die("Ouverture du fichier comptes.csv impossible");
        $writing = fopen('myfile.tmp', 'w');

        $replaced = false;

        // on écrit chaque ligne sauf lorsque l'on tombe sur la ligne du compte que l'on remplace par les nouveaux champs
        while (!feof($reading)) {
            $line = fgets($reading);
            if (stristr($line, $_SESSION["id"])) 
            {
                $line = $_SESSION["id"].",".$_POST["username"].",".$_POST["password"]."\n";
                $replaced = true;
            }

            fputs($writing, $line);
        }
        fclose($reading); 
        fclose($writing);

        // on ferme les fichiers pour éviter les problèmes
        if ($replaced) 
        {
        rename('myfile.tmp', 'comptes.csv');
        } else {
        unlink('myfile.tmp');
        }


        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];

        echo "<script> window.location.replace(\"profil.php\");</script>";
    }
?>

</body>
</html>