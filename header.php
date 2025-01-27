<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Blog Project</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/public/index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/public/index.php?controller=post&action=create">Maak Post</a></li>
                    <li><a href="/public/index.php?controller=user&action=logout">Uitloggen (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="/public/index.php?controller=user&action=login">Inloggen</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
