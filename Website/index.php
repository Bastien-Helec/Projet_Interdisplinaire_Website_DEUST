<?php
// echo "<h1> Zone d'exemple </h1>";
// require_once "Exemple/Controller_exemple.php";

echo "Header : " ;

require_once "./Controller/Head/Head_Controller.php";


echo "Body : ";

require_once "./Controller/Body/Home/Home_Controller.php";

echo "Footer : ";


require_once "./Controller/Foot/Foot_Controller.php";


?>