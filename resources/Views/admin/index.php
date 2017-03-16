<?php include __DIR__ .'/../partials/header.php';

if (isset($_SESSION['errors']['login_success']) && $_SESSION['errors']['login_success'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $_SESSION['errors']['login_success'];
            unset($_SESSION['errors']['login_success']);
        ?>
    </div>
<?php endif; ?>

<h1>Page dashboard admin</h1>
<section>
    <ul class="nav">
        <li><a href=<?php echo URL . '/admin/posts'; ?>>Liste de posts</a></li>
        <li><a href=<?php echo URL . '/admin/comments'; ?>>Liste des commentaires signalés</a></li>
    </ul>
</section>
