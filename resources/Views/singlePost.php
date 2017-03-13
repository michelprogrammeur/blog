<?php include __DIR__ .'/../../resources/Views/partials/header.php';

if (isset($_SESSION['errors']['comment_report']) && $_SESSION['errors']['comment_report'] != "") {
    echo "<p class='success'>" . $_SESSION['errors']['comment_report'] . "</p>";
    unset($_SESSION['errors']['comment_report']);
}
if (isset($_SESSION['errors']['comment_add']) && $_SESSION['errors']['comment_add'] != "") {
    echo "<p class='success'>" . $_SESSION['errors']['comment_add'] . "</p>";
    unset($_SESSION['errors']['comment_add']);
}
if (isset($_SESSION['errors']['comment_add_reply']) && $_SESSION['errors']['comment_add_reply'] != "") {
    echo "<p class='success'>" . $_SESSION['errors']['comment_add_reply'] . "</p>";
    unset($_SESSION['errors']['comment_add_reply']);
}
?>

<div id="billet">
    <p><?php echo $post->title; ?></p>
    <p><?php echo $post->content; ?></p>
</div>

<?php if(isset($_SESSION['user'])) : ?>
    <form id="comment" method="post" action=<?php echo "/blog/post/" . $post->id . "/add"; ?>>
        <div id="comment-field">
            <label>Votre commentaire</label>
            <textarea name="message"></textarea>
        </div>
        <button type="submit">Commenter</button>
    </form>
<?php endif; ?>

<?php
if(isset($comments) && !empty($comments)) {
    foreach ($comments as $comment) {
        require "comments/comments.php";
    }
}
?>

<?php if(isset($_SESSION['user'])) : ?>
    <form style="display: none" id="form_reply" method="post" action=<?=  URL . '/comments/add/reply/' . $post->id ?>>
        <label>Votre réponse</label>
        <textarea name="message" placeholder="Votre commentaire..."></textarea>
        <input id="reply_id" name="reply_id" type="hidden" value="0">

        <button  type="submit">Envoyer</button>
    </form>
<?php endif; ?>


<script src="<?= URL . '/public/assets/js/app.js' ?>"></script>
