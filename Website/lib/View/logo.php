<?php

if(!empty ($logos)){
    // var_dump($logo);


        foreach ($logos as $logo) {
        $data= $logo->gen_logo();
        echo '<img src="'.$data['src'].'" alt="" id="'.$data['id'].'" class="'.$data['class'].'"/>';
        }
    }
    else {
    echo "<p> Pas de logo a afficher </p>";
}
?>