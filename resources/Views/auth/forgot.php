<?php include __DIR__ .'/../../partials/header.php'; ?>

<h1>Page oubli de mot de passe</h1>

<form id="forgot" method="post" action=<?= URL . "/send-password" ?>>
    <div id="forgot-email">
        <label>Email</label>
        <input type="email" name="email" value="">
    </div>
    <button type="submit">Envoyer</button>
</form>