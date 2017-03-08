<?php include __DIR__ .'/../partials/header.php'; ?>

<?php
if (isset($_SESSION['errors']['login_success']) && $_SESSION['errors']['login_success'] != "") {
    echo "<p>" . $_SESSION['errors']['login_success'] . "</p>";
    unset($_SESSION['errors']['login_success']);
}
?>

<h1>Page dashboard admin</h1>



<section>
    <ul class="nav">
        <li><a href=<?php echo URL . '/admin/posts'; ?>>Liste de posts</a></li>
        <li>
            <ul>
                <li class="active"><a href=<?php echo URL . '/admin/post/create'; ?>>créer</a></li>
            </ul>
        </li>
        <li><a href=<?php echo URL . '/admin/comments'; ?>>Liste des commentaires signalés</a></li>
    </ul>
</section>
