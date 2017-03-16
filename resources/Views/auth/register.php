<?php include __DIR__ .'/../partials/header.php';

if (isset($_SESSION['errors']['error_pseudo']) && $_SESSION['errors']['error_pseudo'] != "") : ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['error_pseudo'];
            unset($_SESSION['errors']['error_pseudo']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['error_email']) && $_SESSION['errors']['error_email'] != "") : ?>
<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $_SESSION['errors']['error_email'];
        unset($_SESSION['errors']['error_email']);
    ?>
</div>
<?php endif;
if (isset($_SESSION['errors']['error_password']) && $_SESSION['errors']['error_password'] != "") : ?>
<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $_SESSION['errors']['error_password'];
        unset($_SESSION['errors']['error_password']);
    ?>
</div>
<?php endif;?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1>Page d'enregistrement</h1>
        <form method="post" action="">
            <div class="form-group">
                <label class="control-label" for="inputLarge">Pseudo</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="pseudo" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Email</label>
                <input id="inputLarge" class="form-control input-lg" type="email" name="email" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Mot de passe</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="password" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Comfimation mot de passe</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="password_confirm" value="">
            </div>

            <button class="btn btn-info" type="submit">S'inscrire</button>
        </form>
    </div>
</div>