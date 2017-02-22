<h1>Page d'enregistrement</h1>

<?php if(!empty($_SESSION['errors'])): ?>
    <div>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <ul>
                <li><?php echo $error; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

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
    <button type="submit">S'inscrire</button>
</form>