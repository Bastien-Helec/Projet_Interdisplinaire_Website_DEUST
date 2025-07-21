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


//Partie Footer
echo'
<link rel="stylesheet" href="./Controller/Foot/Foot_CSS_Controller.php">
';

// Header contient la navbar et l'entête
require_once "./Controller/Head/Head_Controller.php";

// Le corps du site
if (empty($_GET)){
    require_once "./Controller/Body/Home/Home_Controller.php";
        echo'
        <link rel="stylesheet" href="./Controller/Body/Home/Actus/Actus_CSS_Controller.php">
        <link rel="stylesheet" href="./Controller/Body/Home/Section_1/Section_1_CSS_Controller.php">';
}
if (isset($_GET['page'])){
    switch ($_GET['page']){
        
        case 'activities':
            echo "<h1> Activités </h1>";
            echo'
            <link rel="stylesheet" href="./Controller/Body/Activities/planning_activities/planning_Activities_CSS_Controller.php">
            <link rel="stylesheet" href="./Controller/Body/Activities/li_activities/li_Activities_CSS_Controller.php">';
            
            require_once "./Controller/Body/Activities/Activities_Controller.php";

            break;
            
        case 'planning':
            echo "<h1> Planning </h1>";
            break;

        case 'conferences':
            echo "<h1> Conférences </h1>";
            break;
        }
}

// Le pied du site
require_once "./Controller/Foot/Foot_Controller.php";


?>