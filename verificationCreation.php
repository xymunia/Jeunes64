<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Création...</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>
</head>
<body>

<p>Création du compte...</p>


<?php
    session_start();

    $_SESSION['existe'] = false;


    // on ouvre le fichier csv contenant tout les comptes
    $file = fopen("comptes.csv", "r+") or die("Ouverture du fichier comptes.csv impossible");

    $id = 0;

    // on fait une liste tel que liste["nom d'utilisateur"]=motdepasse et on prend un id pas encore associé à un compte
    $db = array();
    while(!feof($file)) 
    {
        if($id!=0)
        {
            $db[$data[1]] = $data[2];
        }
        $line = fgets($file);
        $data = explode(',', $line);
        $id++;
    }

    // on compare les identifiants pour savoir si le compte existe deja
    $conditions = (isset($db[$_SESSION['username']]) && strcmp($db[$_SESSION['username']], $_SESSION['password'] ));
    if($conditions) // le compte existe deja
    {
        $_SESSION['existe'] = true;



        fclose($file);

        // on redirige vers la page de creation de compte
        echo "<script> window.location.replace('creation.php'); </script>";
    }
    else //le compte n'existe pas 
    {

        
        // l'utilisateur est connecté
        $_SESSION['connecte'] = true;

        $id = $id + 1001;

        // on ecrit la validation dans le fichier csv
        $txt = $id.",".$_SESSION["username"].",".$_SESSION["password"]."\n";

        $_SESSION["id"] = $id;

        fwrite($file, $txt);

        fclose($file);

        // on redirige vers le menu
        echo "<script> window.location.replace('menu.php'); </script>";
    }

    
?>


</body>
</html>