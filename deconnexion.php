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
	<title>Deconnexion</title>
    <link rel="stylesheet" type="text/css" href="#">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"></meta>

    <style>

    </style>
</head>
<body>


<?php
    // retire toutes les variables de sesion
    session_unset();

    // détruit la session
    session_destroy();

    echo "<script> window.location.replace(\"http://localhost/Jeunes/jeune/index.php\");</script>";

?>

<!--
    commentaire html
-->

</body>
</html>



<?php


    
?>