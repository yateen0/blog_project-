<?php
// Post.php

require_once 'Database.php';
require_once 'ORMInterface.php';

class Post implements ORMInterface {
    private $id;
    private $title;
    private $content;
    private $userID;
    private $createdAt;

    public function __construct($title, $content, $userID) {
        $this->title = $title;
        $this->content = $content;
        $this->userID = $userID;
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        if ($this->id) {
            $stmt = $db->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
            $stmt->execute([$this->title, $this->content, $this->id]);
        } else {
            $stmt = $db->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
            $stmt->execute([$this->title, $this->content, $this->userID]);
            $this->id = $db->lastInsertId();
        }
    }

    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$this->id]);
    }

    public function getID() {
        return $this->id;
    }

    public static function findByID($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $post = new Post($data['title'], $data['content'], $data['user_id']);
            $post->id = $data['id'];
            $post->createdAt = $data['created_at'];
            return $post;
        }
        return null;
    }

    public static function findAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM posts");
        $posts = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post($data['title'], $data['content'], $data['user_id']);
            $post->id = $data['id'];
            $post->createdAt = $data['created_at'];
            $posts[] = $post;
        }
        return $posts;
    }
}
