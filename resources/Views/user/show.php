<h2>Votre profile utilisateur</h2>

<span>Email</span>
<form id="" method="post" action=<?= URL . "/account/email-update" ?>>
    <div>
        <label>Ancien email</label>
        <input type="text" name="old_email"/>
    </div>
    <div>
        <label>Nouvel email</label>
        <input type="text" name="new_email"/>
    </div>

    <button type="submit">Modifier Email</button>
</form>

<span>Mot de passe</span>
<form id="" method="post" action=<?= URL . "/account/password-update" ?>>
    <div>
        <label>Ancien mot de passe</label>
        <input type="text" name="old_password"/>
    </div>
    <div>
        <label>Nouveau mot de passe</label>
        <input type="text" name="new_password"/>
    </div>
    <div>
        <label>Confirmation nouveau mot de passe</label>
        <input type="text" name="new_password_confirm"/>
    </div>

    <button type="submit">Modifier password</button>
</form>