<?php if(!empty($_SESSION['errors'])): ?>
    <div>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <ul>
                <li><?php echo $error; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

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