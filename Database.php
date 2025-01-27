<?php
// Database.php
// Deze klasse beheert de databaseverbinding en zorgt ervoor dat er slechts één instantie wordt gebruikt (singleton patroon).

class Database {
    private static $instance = null; // Singleton instantie
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=blog_project', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Databaseverbinding mislukt: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
