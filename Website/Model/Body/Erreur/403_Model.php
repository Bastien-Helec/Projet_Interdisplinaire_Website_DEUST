<?php

$error_forbiden_div = new Div('forbiden_Div_ID' , '403_Div_CLS', [
    new Glob_Fields('403_txt_ID', '403_txt_CLS', 'h1', ['Erreur 403']),
    new Glob_Fields('403_txt2_ID', '403_txt2_CLS', 'p', ['Accès interdit. Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
    ]
),
]);


$error_forbiden = $error_forbiden_div->gen_div();

?>