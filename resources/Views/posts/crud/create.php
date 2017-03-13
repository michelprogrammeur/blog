<?php
if (isset($_SESSION['errors']['post_add_error']) && $_SESSION['errors']['post_add_error'] != "") {
    echo "<p>" . $_SESSION['errors']['post_add_error'] . "</p>";
    unset($_SESSION['errors']['post_add_error']);
}
?>



<form id="post" method="post" action="/blog/admin/post/store">
    <div id="post-title">
        <label>Title</label>
        <input type="text" name="title" value="">
    </div>
    <div id="post-content">
        <label>Contenu</label>
        <textarea name="content" placeholder="Votre texte ..."></textarea>
    </div>
    <button type="submit">Poster</button>
</form>
