<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class BaseForm {
    protected string $id_banner;
    protected string $message;
    protected bool $isPost;
    protected PDO $pdo;
    
    public function __construct( string $id_banner, string $message, PDO $pdo) {
        $this->isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $this->id_banner = $id_banner;
        $this->message = $message;
        $this->pdo = $pdo;

    }
}
