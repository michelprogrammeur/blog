<?php include __DIR__ .'/../../resources/Views/partials/header.php';

if (isset($_SESSION['errors']['comment_report']) && $_SESSION['errors']['comment_report'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['comment_report'];
            unset($_SESSION['errors']['comment_report']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['comment_add']) && $_SESSION['errors']['comment_add'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['comment_add'];
            unset($_SESSION['errors']['comment_add']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['comment_add_reply']) && $_SESSION['errors']['comment_add_reply'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['comment_add_reply'];
        unset($_SESSION['errors']['comment_add_reply']);
        ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <h1><?= $post->title; ?></h1>
        <div class="well">
            <strong>SYNOPSIS : </strong><?= $post->abstract; ?>
        </div>
        <div style="padding: 0 0 26px 0">
            <?= html_entity_decode($post->content); ?>
        </div>

        <?php if(isset($_SESSION['user'])) : ?>
            <form style="padding: 20px 0 40px 0" method="post" action=<?= "/blog/post/" . $post->id . "/add"; ?>>
                <div class="form-group">
                    <label class="control-label" for="inputDefault">Votre commentaire</label>
                    <input type="text" class="form-control" id="inputDefault" name="message" placeholder="Votre commentaire...">
                </div>
                <button class="btn btn-info" type="submit">Commenter</button>
            </form>
        <?php endif; ?>

        <?php
        if(isset($comments) && !empty($comments)) {
            foreach ($comments as $comment) {
                require "comments/comments.php";
            }
        }
        ?>
        <!-- Formulaire de réponce -->
        <?php if(isset($_SESSION['user'])) : ?>
            <form style="display: none" id="form_reply" method="post" action=<?=  URL . '/comments/add/reply/' . $post->id ?>>
                <div class="form-group">
                    <label class="control-label" for="inputDefault">Réponces</label>
                    <input type="text" class="form-control" id="inputDefault" name="message" placeholder="Votre commentaire...">
                    <input id="reply_id" name="reply_id" type="hidden" value="0">
                </div>

                <button class="btn btn-info" type="submit">Envoyer</button>
            </form>
        <?php endif; ?>
    </div>
</div>






<script src="<?= URL . '/public/assets/js/app.js' ?>"></script>
