<?php include __DIR__ . '/layouts/header.php'; ?>

<h2>Maak een nieuwe post</h2>
<form method="POST" action="/public/index.php?controller=post&action=create">
    <label for="title">Titel:</label>
    <input type="text" id="title" name="title" required>
    
    <label for="content">Inhoud:</label>
    <textarea id="content" name="content" required></textarea>
    
    <button type="submit">Post aanmaken</button>
</form>

<?php include __DIR__ . '/layouts/footer.php'; ?>
