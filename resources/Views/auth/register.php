
<?php
if (isset($_SESSION['errors']['error_pseudo']) && $_SESSION['errors']['error_pseudo'] != "") {
    echo "<p>" . $_SESSION['errors']['error_pseudo'] . "</p>";
    unset($_SESSION['errors']['error_pseudo']);
}
if (isset($_SESSION['errors']['error_email']) && $_SESSION['errors']['error_email'] != "") {
    echo "<p>" . $_SESSION['errors']['error_email'] . "</p>";
    unset($_SESSION['errors']['error_email']);
}
if (isset($_SESSION['errors']['error_password']) && $_SESSION['errors']['error_password'] != "") {
    echo "<p>" . $_SESSION['errors']['error_password'] . "</p>";
    unset($_SESSION['errors']['error_password']);
}
?>



<h1>Page d'enregistrement</h1>
<form id="register" method="post" action="">
    <div id="register-pseudo">
        <label>Pseudo</label>
        <input type="text" name="pseudo" value="">
    </div>
    <div id="register-email">
        <label>Email</label>
        <input type="email" name="email" value="">
    </div>
    <div id="register-password">
        <label>Mot de passe</label>
        <input type="text" name="password" value="">
    </div>
    <div id="register-password">
        <label>confirmation mot de passe</label>
        <input type="text" name="password_confirm" value="">
    </div>
    <button type="submit">S'inscrire</button>
</form>