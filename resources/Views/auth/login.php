<?php
if (isset($_SESSION['errors']['error_login']) && $_SESSION['errors']['error_login'] != "") {
    echo "<p>" . $_SESSION['errors']['error_login'] . "</p>";
    unset($_SESSION['errors']['error_login']);
}
?>

<h1>Page de connexion</h1>

<form id="login" method="post" action="/blog/login">
    <div id="login-email">
        <label>Email</label>
        <input type="email" name="email" value="">
    </div>
    <div id="login-password">
        <label>Mot de passe</label>
        <input type="text" name="password" value="">
    </div>
    <button type="submit">Connexion</button>
</form>