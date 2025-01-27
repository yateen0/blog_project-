<?php
// PostController.php
require_once __DIR__ . '/../models/Post.php';

class PostController {
    public function index() {
        session_start();
        $posts = Post::findAll();
        include __DIR__ . '/../views/posts.php';
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /public/index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $userID = $_SESSION['user_id'];

            $post = new Post($title, $content, $userID);
            $post->save();
            header('Location: /public/index.php');
            exit;
        }
        include __DIR__ . '/../views/create_post.php';
    }
}
