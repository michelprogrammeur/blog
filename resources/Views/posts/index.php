<h1>Liste des épisodes</h1>
<?php
if (isset($_SESSION['errors']['post_add']) && $_SESSION['errors']['post_add'] != "") {
    echo "<p>" . $_SESSION['errors']['post_add'] . "</p>";
    unset($_SESSION['errors']['post_add']);
}
if (isset($_SESSION['errors']['post_update']) && $_SESSION['errors']['post_update'] != "") {
    echo "<p>" . $_SESSION['errors']['post_update'] . "</p>";
    unset($_SESSION['errors']['post_update']);
}
if (isset($_SESSION['errors']['post_delete']) && $_SESSION['errors']['post_delete'] != "") {
    echo "<p>" . $_SESSION['errors']['post_delete'] . "</p>";
    unset($_SESSION['errors']['post_delete']);
}
?>


<?php foreach ($posts as $post) : ?>
    <div id="billet">
        <p><?php echo $post->title; ?></p>
        <p><?php echo $post->content; ?></p>
        <a href="<?php  echo URL . '/admin/post/' . $post->id . "/edit"; ?>">Modifications</a>

        <form action="<?php echo URL . '/admin/post/' . $post->id . "/delete"; ?>" method="post">
            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez vous vraiment supprimer l\'article');">Delete</button>
        </form>
    </div>
    </br>
<?php endforeach; ?>

