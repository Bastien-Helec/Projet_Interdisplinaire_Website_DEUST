<?php

class Auth extends BaseForm {

    private function auth($db_columns,$first_name_db,$last_name_db,$mail_db,$mail_name,$passwd_name,$psswd_db, $db_table) {
        $email = $_POST[$mail_name];
        $password = $_POST[$passwd_name];
        if ($_POST['btn_value_envoi'] === ""){
            unset($_POST['btn_value_envoi']);
        }
        
        // On verifie si le mot de passe est correct
        $cnx_sql = new SQL_Select($db_columns,$db_table, "$mail_db = '$email'");
        // echo $cnx_sql->getSQL();
        $result = $cnx_sql->execute_Simple_SQL( "$mail_db='$email'" ,$this->pdo);
        // var_dump($result);
        

        // On verifie si le mot de passe est correct
        if (!empty($result)) {
            if ($result[0][$mail_db] === $email) {
                $state_email = true;
                if (password_verify($password, $result[0][$psswd_db])) {
                    $state_pass = true;
                } else {
                    $state_pass = false;
                }
            } else {
                $state_email = false;
            }
        }


        unset($_POST[$mail_name], $_POST[$passwd_name]);

    
        if (!empty($result)) {
            if ($state_email === true) {
                $state_mail_mess= "Success"; 
                if ($state_pass === true) {
                    $state_pass_mess = "Success";
                    $this->message = "Bienvenue, {$result[0][$first_name_db]} {$result[0][$last_name_db]} $this->message";

                } else {
                    $state_pass_mess = "Error";
                    $this->message = "Mot de passe incorrect";
                }
            } else {
                $state_mail_mess= "Error";
                $this->message = "Email incorrect";
            }

            if ($state_mail_mess === "Success" && $state_pass_mess === "Success") {
                $Status = "Success";
                $_SESSION['email']= $email;
                $_SESSION['login_status'] = $Status;
            }else{
                $Status = "Error";
            } 

            $response = ([
                'Status' => $Status,
                'status_email' => $state_mail_mess,
                'status_pass' => $state_pass_mess,
                'message' => $this->message,
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => $this->message
                ],
                'user' => [
                    'prenom' => $result[0][$first_name_db],
                    'nom' => $result[0][$last_name_db],
                    'email' => $result[0][$mail_db]
                ]
            ]);
        } else {
            $response = ([
                'Status' => 'Error',
                'message' => 'Identifiants invalides',
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => 'Identifiants invalides'
                
                ]
            ]);
        }
        echo json_encode($response);            
        exit;
    }

public function FORM_Connect($db_columns, $first_name_db, $last_name_db, $mail_db, $mail_name, $passwd_name, $psswd_db, $db_table) {
    if ($this->isPost) {
        if (isset($_POST[$mail_name]) && isset($_POST[$passwd_name]) && count($_POST) === 2) {
            $this->auth($db_columns, $first_name_db, $last_name_db, $mail_db, $mail_name, $passwd_name, $psswd_db, $db_table);
        } else {
            echo json_encode([
                'Status' => 'Error',
                'message' => 'Erreur de traitement',
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => 'Erreur de traitement'
                ],
                'Error_isPost' => $this->isPost,
                'Error_After_isPost' => $this->auth($db_columns, $first_name_db, $last_name_db, $mail_db, $mail_name, $passwd_name, $psswd_db, $db_table),
            ]);
            exit;
        }
    }
}
}
?>