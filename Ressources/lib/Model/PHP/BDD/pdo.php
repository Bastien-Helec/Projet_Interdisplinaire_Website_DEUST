<?php

/**
 * PDO ++ 
 * Execution plus rapide pour les PDO
 * 
 */


class DBPDO {
    private string $HOST ;
    private string $DBNAME ;
    
    private string $USER ;
    private string $PASSWORD ;
    private string $PORT ;
    
    private const CHARSET = 'utf8mb4';
    private ?PDO $pdo = null;

    public function __construct(string $HOST, string $DBNAME, string $USER, string $PASSWORD, string $PORT) {
        $this->HOST = $HOST;
        $this->DBNAME = $DBNAME;
        $this->USER = $USER;
        $this->PASSWORD = $PASSWORD;
        $this->PORT = $PORT;
    }

    public function connect(): PDO {
        if ($this->pdo === null) {
            $dsn = "mysql:host={$this->HOST};dbname={$this->DBNAME};port={$this->PORT};charset=" . self::CHARSET;
            try {
                $this->pdo = new PDO($dsn, $this->USER, $this->PASSWORD);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                echo "Connected to the database successfully.";
            } catch (PDOException $e) {
                throw new Exception("Connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

}

?>
