<?php
if (isset($_SESSION['errors']['post_update_error']) && $_SESSION['errors']['post_update_error'] != "") {
    echo "<p>" . $_SESSION['errors']['post_update_error'] . "</p>";
    unset($_SESSION['errors']['post_update_error']);
}
?>



<form id="post" method="post" action=<?php echo "/blog/admin/post/" . $post->id . "/update" ?>>
    <div id="post-title">
        <label>Title</label>
        <input type="text" name="title" value="<?= $post->title ?>">
    </div>
    <div id="post-content">
        <label>Contenu</label>
        <textarea name="content" placeholder="Votre texte ..."><?= $post->content ?></textarea>
    </div>
    <button type="submit">Modifier</button>
</form>