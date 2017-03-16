<?php include __DIR__ .'/../partials/header.php'; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>Votre profile utilisateur</h2>
        <h3 style="padding: 20px 0 0 0">Email</h3>
        <form method="post" action=<?= URL . "/account/email-update" ?>>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Ancien email</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="old_email" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Nouvel email</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="new_email" value="">
            </div>
            <button class="btn btn-info" type="submit">Modifier Email</button>
        </form>

        <h3 style="padding: 20px 0 0 0">Mot de passe</h3>
        <form method="post" action=<?= URL . "/account/password-update" ?>>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Ancien mot de passe</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="old_password" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Nouveau mot de passe</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="new_password" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="inputLarge">Confirmation nouveau mot de passe</label>
                <input id="inputLarge" class="form-control input-lg" type="text" name="new_password_confirm" value="">
            </div>

            <button class="btn btn-info" type="submit">Modifier password</button>
        </form>
    </div>
</div>