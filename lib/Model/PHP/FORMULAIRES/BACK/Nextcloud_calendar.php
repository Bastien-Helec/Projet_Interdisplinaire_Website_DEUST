<?php

Class Nextcloud_calendar extends BaseForm{
    private String $calendar_base_url_dav;
    private String $calendar_name;
    private String $objet;
    private string $start_date;
    private string $end_date;
    private String $uid;
    private String $username = 'Salle_Agenda';

    public function __construct($calendar_base_url_dav, $calendar_name, $objet ,$start_date, $end_date, $username) {
        $this->calendar_base_url_dav = $calendar_base_url_dav;
        $this->calendar_name = $calendar_name;
        $this->objet = $objet;
        $this->start_date = date('Ymd\This\z',strtotime($start_date));
        $this->end_date = date('Ymd\This\z',strtotime($end_date));
        $this->uid = uniqid() . '@ville-pezenas.fr';
        $this->username = $username;
    }

    private function gen_event(){
        $event = "
        BEGIN:VCALENDAR\r\n".
        "VERSION:2.0\r\n" .
        "PRODID:-//Your Organization//NONSGML v1.0//EN\r\n" .
        "BEGIN:VEVENT\r\n" .
        "UID:$this->uid\r\n" .
        "SUMMARY:$this->objet\r\n" .
        "DTSTART:$this->start_date\r\n" .
        "DTEND:$this->end_date\r\n" .
        "STATUS:CONFIRMED\r\n" .
        "END:VEVENT\r\n" .
        "END:VCALENDAR\r\n";
        return $event;
    }

    private function gen_cnx () {
        $curl_init= curl_init( "{$this->calendar_base_url_dav}/{$this->username}/{$this->calendar_name}/{$this->uid}.ics");
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_init, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl_init, CURLOPT_USERPWD, 'Salle_Agenda:SalleAgenda34'); 
        curl_setopt($curl_init, CURLOPT_POSTFIELDS, $this->gen_event());
        $event = $this->gen_event();
        curl_setopt($curl_init, CURLOPT_VERBOSE, true);
        curl_setopt($curl_init, CURLOPT_POSTFIELDS, $event);
        curl_setopt($curl_init, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/calendar; charset=utf-8',
            'Content-Length: ' . strlen($event)
        ));

        curl_setopt($curl_init, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_init, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec($curl_init);
        $http_code = curl_getinfo($curl_init, CURLINFO_HTTP_CODE);


        if (curl_errno($curl_init)) {
            echo "<script> console.log('Erreur cURL: " . curl_error($curl_init) . "');</script>";
        }else {
            if ($http_code == 201) {
                echo "<script> console.log('Événement créé avec succès');</script>";
            } else {
                echo "<script> console.log('Erreur lors de la création de l\'événement: HTTP Code " . $http_code . "');</script>";
                echo "<script> console.log('Réponse du serveur connexion nextcloud: " . $response . "');</script>";
            }
        }

        curl_close($curl_init);

    }

    private function enable_proxy(){
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization');
            exit;
        }

        $AllowedUrl= "{$this->calendar_base_url_dav}/{$this->username}/{$this->calendar_name}/";

        if (!isset($_GET['url'])) {
            http_response_code(400);
            echo "<script> console.log('Aucune URL fournie');</script>";
            exit;
        }

        $url = $_GET['url'];

        if ($url !== $AllowedUrl) {
            http_response_code(403); // Forbidden
            echo "<script> Erreur : URL cible non autorisée. </script>";
            exit;   
        }

        // Récupérer la méthode HTTP utilisée
        $method = $_SERVER['REQUEST_METHOD'];

        // Préparer les en-têtes pour la requête proxy
        $headers = [];
        foreach (getallheaders() as $key => $value) {
            $headers[] = "$key: $value";
        }

        // Initialiser cURL pour envoyer la requête
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Si la méthode est PUT ou POST, inclure le corps de la requête
        if ($method === 'PUT' || $method === 'POST') {
            $body = file_get_contents('php://input');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        // Exécuter la requête cURL et récupérer la réponse
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Vérifier les erreurs de cURL
        if ($response === false) {
            $errorMsg = curl_error($ch);
            http_response_code(500); // Internal Server Error
            echo "<script> Erreur de cURL : $errorMsg </script>";
            curl_close($ch);
            exit;
        }

        // Transférer la réponse et le code HTTP au client
        header("Content-Type: text/plain");
        http_response_code($httpCode);
        echo "<script> $response  </script>";
        curl_close($ch);
    }

    public function send() {
        // $this->enable_proxy();
            $this->gen_cnx();
    }


}