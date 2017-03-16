<?php include __DIR__ .'/../../partials/header.php';

if (isset($_SESSION['errors']['post_add_error']) && $_SESSION['errors']['post_add_error'] != "") : ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['post_add_error'];
        unset($_SESSION['errors']['post_add_error']);
        ?>
    </div>
<?php endif; ?>



<form id="post" method="post" action="/blog/admin/post/store">
    <div class="form-group">
        <label class="control-label" for="inputLarge">Titre</label>
        <input id="inputLarge" class="form-control input-lg" type="text" name="title" value="">
    </div>
    <div class="form-group">
        <label class="control-label" for="inputLarge">Extrait de l'épisode</label>
        <textarea style="resize: none;" id="inputLarge" class="form-control input-lg" name="abstract" placeholder="Extrait ..."></textarea>
    </div>
    <div id="post-content">
        <label>Contenu</label>
        <textarea style="resize: none;" id="content" name="content" placeholder="Votre texte ..."></textarea>
    </div>
    <div class="text-right">
        <button class="btn btn-success" type="submit">Poster</button>
    </div>
</form>
