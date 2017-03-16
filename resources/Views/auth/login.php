<?php include __DIR__ .'/../partials/header.php';

if (isset($_SESSION['errors']['register_success']) && $_SESSION['errors']['register_success'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['register_success'];
            unset($_SESSION['errors']['register_success']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['error_login']) && $_SESSION['errors']['error_login'] != "") : ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['error_login'];
            unset($_SESSION['errors']['error_login']);
        ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1>Page de connexion</h1>
        <form id="login" method="post" action="/blog/login">
            <div class="form-group">
                <label class="control-label" for="inputLarge">Email</label>
                <input id="inputLarge" class="form-control input-lg" type="email" name="email" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Mot de passe</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="password" value="">
            </div>
            <button class="btn btn-info" type="submit">Connexion</button>
        </form>
    </div>
</div>