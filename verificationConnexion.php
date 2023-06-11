<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion...</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
</head>



<p>Connexion...</p>

<?php
    session_start();

    $_SESSION['connecte'] = false;

    // on ouvre le fichier des comptes
    $file = fopen("comptes.csv","r+")or die("erreur lors de l'ouverture de comptes.csv");

    $i = 0;

    $db = array();
    while(!feof($file)) // on fait une liste des comptes tel que db["nom d'utilisateur"]= motdepasse, id du compte
    {

        if($i != 0)
        {
            $db[$data[1]] = [$data[2], $data[0]];
        }
        else{
            $i=1;
        }

        $line = fgets($file);
        $data = explode(',', $line);
    }

    fclose($file);



    $conditions = (isset($db[$_SESSION['username']]) && strcmp($db[$_SESSION['username']][0], $_SESSION['password'])==0);
    if($conditions) // si le username et le password correspondent
    {
        $_SESSION['connecte'] = true;
        $_SESSION["id"] = $db[$_SESSION['username']][1];
        
        $home = "menu.php";
        
       
    }
    else
    {
        $home="connexion.php";
    }
    echo "<script> window.location.replace('".$home."'); </script>";
?>

<!--
    commentaire 
-->

</body>
</html>