<?php include __DIR__ .'/../partials/header.php';

if (isset($_SESSION['errors']['post_add']) && $_SESSION['errors']['post_add'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['post_add'];
        unset($_SESSION['errors']['post_add']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['post_update']) && $_SESSION['errors']['post_update'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['post_update'];
        unset($_SESSION['errors']['post_update']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['post_delete']) && $_SESSION['errors']['post_delete'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['post_delete'];
        unset($_SESSION['errors']['post_delete']);
        ?>
    </div>
<?php endif; ?>

<h1 xmlns="http://www.w3.org/1999/html">Liste des épisodes</h1>
<h4><a href=<?php echo URL . '/admin/post/create'; ?>>Créer</a></h4>

<?php foreach ($posts as $post) : ?>
    <div id="billet">
        <div class="billet-format">
            <h2><?= $post->title; ?></h2>
            <div class="well"><?= "SYNOPSIS :" . $post->abstract; ?></div>
        </div>

        <form class="text-right" action="<?= URL . '/admin/post/' . $post->id . "/delete"; ?>" method="post">
            <a class="btn btn-info" href="<?= URL . '/admin/post/' . $post->id . "/edit"; ?>">Modifier</a>
            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez vous vraiment supprimer l\'article');">Supprimer</button>
        </form>
    </div>
    </br>
<?php endforeach; ?>

