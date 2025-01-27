<?php
// User.php
// Het model voor gebruikersbeheer.

require_once 'Database.php';
require_once 'ORMInterface.php';

class User implements ORMInterface {
    private $id;
    private $username;
    private $password;
    private $role;

    public function __construct($username, $password, $role = 'user') {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        if ($this->id) {
            // Bijwerken van een bestaande gebruiker
            $stmt = $db->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
            $stmt->execute([$this->username, $this->password, $this->role, $this->id]);
        } else {
            // Nieuwe gebruiker toevoegen
            $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->execute([$this->username, $this->password, $this->role]);
            $this->id = $db->lastInsertId();
        }
    }

    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$this->id]);
    }

    public function getID() {
        return $this->id;
    }

    public static function findByID($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $user = new User($data['username'], $data['password'], $data['role']);
            $user->id = $data['id'];
            return $user;
        }
        return null;
    }

    public static function findAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM users");
        $users = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($data['username'], $data['password'], $data['role']);
            $user->id = $data['id'];
            $users[] = $user;
        }
        return $users;
    }
}
