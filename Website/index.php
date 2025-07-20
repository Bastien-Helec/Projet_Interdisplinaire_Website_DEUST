<?php
// echo "<h1> Zone d'exemple </h1>";
// require_once "Exemple/Controller_exemple.php";

echo '

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

<head>
<link rel="icon" href="Images_principal/icone_site.png" type="image/png">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Congrès national </title>
';

// Global / Base 

echo '<link rel="stylesheet" href="./Controller/Base_CSS_Controller.php">';

// Partie Header
echo'
<link rel="stylesheet" href="./Controller/Head/Header/Header_CSS_Controller.php">
<link rel="stylesheet" href="./Controller/Head/Navbar/Navbar_CSS_Controller.php">
';

// Partie body accueil
echo'
<link rel="stylesheet" href="./Controller/Body/Home/Actus/Actus_CSS_Controller.php">
<link rel="stylesheet" href="./Controller/Body/Home/Section_1/Section_1_CSS_Controller.php">';

//Partie Footer
echo'
<link rel="stylesheet" href="./Controller/Foot/Foot_CSS_Controller.php">
';

// Header contient la navbar et l'entête
require_once "./Controller/Head/Head_Controller.php";

// Le corps du site
require_once "./Controller/Body/Home/Home_Controller.php";

// Le pied du site
require_once "./Controller/Foot/Foot_Controller.php";


?>