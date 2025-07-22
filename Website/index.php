<?php
session_start();

if (isset($_GET['logout'])) {
    // 1. Supprimer toutes les variables de session
    $_SESSION = [];

    // 2. Supprimer le cookie de session si existant
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // 3. Détruire la session
    session_destroy();

    // 4. Supprimer d'autres cookies éventuels (si tu en utilises)
    setcookie("autre_cookie", "", time() - 3600); // exemple

    // 5. Redirection vers la page d'accueil ou de login
    header("Location: index.php");
    exit();
}


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
<link rel="stylesheet" href="./Controller/Head/Header/Formulaires/Formulaires_CSS_Controller.php">
<link rel="stylesheet" href="./Controller/Head/Navbar/Navbar_CSS_Controller.php">
';


//Partie Footer
echo'
<link rel="stylesheet" href="./Controller/Foot/Foot_CSS_Controller.php">
';

require_once "./Controller/BDD_Controller.php";

// Header contient la navbar et l'entête
require_once "./Controller/Head/Head_Controller.php";
// var_dump($_SESSION);
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
            
            
        case 'conferences':
            echo "<h1> Conférences </h1>";
            echo'            
            <link rel="stylesheet" href="./Controller/Body/Conferences/planning_conferences/planning_Conferences_CSS_Controller.php">
            <link rel="stylesheet" href="./Controller/Body/Conferences/li_conferences/li_Conferences_CSS_Controller.php">';
                
            require_once "./Controller/Body/Conferences/Conferences_Controller.php";                
            break;
                
        case 'planning':
            echo "<h1> Planning </h1>";
            echo'            
            <link rel="stylesheet" href="./Controller/Body/Planning/planning_CSS_Controller.php">';
            
            require_once "./Controller/Body/Planning/planning_Controller.php";
            break;
        
        case 'admin' : 
            if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] === true ){
                require_once "./Controller/Body/Admin/Admin_Controller.php";
                require "./Controller/Body/Admin/usrs/li_Admin_usr_Controller.php";
                require "./Controller/Body/Admin/act/li_Admin_act_Controller.php";
                require "./Controller/Body/Admin/ses/li_Admin_ses_Controller.php";
            }else {
                require_once "./Controller/Body/Erreur/403_Controller.php";
                echo '<link rel="stylesheet" href="./Controller/Body/Erreur/403_CSS_Controller.php">';
            }
        
            }
            }
            
            // Le pied du site
            require_once "./Controller/Foot/Foot_Controller.php";
?>
<script src="./Controller/Head/Header/Formulaires/Formulaires_JS_Controller.php"></script>