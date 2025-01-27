<?php include __DIR__ . '/layouts/header.php'; ?>

<h2>Inloggen</h2>
<form method="POST" action="/public/index.php?controller=user&action=login">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Wachtwoord:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Inloggen</button>
</form>

<?php include __DIR__ . '/layouts/footer.php'; ?>
