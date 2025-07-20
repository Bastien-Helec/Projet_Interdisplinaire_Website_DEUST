<?php

Class Glob_Handling extends BaseForm {

    private function Insert_data(string $db_table,string $db_columns, $F_names, $F_action,$cdt_plus, $cdts_db) {
        $values=null;

        if (!empty($F_action)) {
            foreach ($F_action as $champ => $action) {
                if (isset($_POST[$champ])) {
                    switch ($action) {
                        case 'password_hash':
                            $_POST[$champ] = password_hash($_POST[$champ], PASSWORD_DEFAULT);
                            break;
                    }
                }
            }
        }

        foreach ($F_names as $f) {
            if (isset($_POST[$f])) {
                if ($_POST[$f] === null || $_POST[$f] === '') {
                } else {
                    $values .= "$_POST[$f],";
                    $values=str_replace(' ', '_' , $values);
                }
            }
        }
        
        if (isset($values) && $values !==null) {
            $values = rtrim($values,',');
            
            $insert_sql = new SQL_Insert($db_columns,$db_table);
            if($cdt_plus === null) {
            $cdts_db= null;
            $insert_sql->execute_Simple_SQL($values, $this->pdo);
            
            echo json_encode ([
                'Status' =>'Success',
                'message' => "$values, Ajouté avec succés dans $db_table",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "".str_replace('_', ' ', $values).", Ajouté avec succés dans $db_table"
                ],
            ]);
            
        } 
            
            else {
                $val_temp_array = explode(',', $values);
                $quoted_values = array_map(function($v) {
                    return "'" . trim($v) . "'";
                }, $val_temp_array);
                $values = implode(', ', $quoted_values);
            $insert_sql->execute_Cmplx_SQL($values,$cdt_plus,$cdts_db,$this->pdo);
            $values = explode(',',$values); 
            
            echo json_encode ([
                'Status' =>'Success',
                'message' => "$values[0], Ajouté avec succés dans $db_table",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "".str_replace('_', ' ', $values[0]).", Ajouté avec succés dans $db_table"
                ],
            ]);
            }


        }
} 


    public function FORM_Interact($db_table, $db_columns, array $f_name, $F_action=[],$cdt_plus=null,$cdts_db=null) {
        if($this->isPost){
            $this->Insert_data($db_table, $db_columns, $f_name, $F_action,$cdt_plus,$cdts_db);
        }
        else {
            echo json_encode([
                'Status' => 'Error',
                'message' => 'Erreur de traitement'
            ]);
            exit;
        }
    }

}
?>