<?php
// UserController.php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../views/layouts/header.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $users = User::findAll();
            foreach ($users as $user) {
                if ($user->username === $username && password_verify($password, $user->password)) {
                    session_start();
                    $_SESSION['user_id'] = $user->getID();
                    $_SESSION['username'] = $user->username;
                    $_SESSION['role'] = $user->role;
                    header('Location: /public/index.php');
                    exit;
                }
            }
            echo '<p style="color: red; text-align: center;">Login mislukt: Controleer je gegevens.</p>';
        }
        include __DIR__ . '/../views/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /public/index.php');
        exit;
    }
}
