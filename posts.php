<?php include __DIR__ . '/layouts/header.php'; ?>

<h2>Blogposts</h2>
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <h3><?= htmlspecialchars($post->title) ?></h3>
            <p><?= htmlspecialchars($post->content) ?></p>
            <small>Geplaatst door gebruiker <?= $post->userID ?> op <?= $post->createdAt ?></small>
        </li>
    <?php endforeach; ?>
</ul>

<?php include __DIR__ . '/layouts/footer.php'; ?>
