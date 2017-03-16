<?php include __DIR__ .'/../../resources/Views/partials/header.php';

if (isset($_SESSION['errors']['login_success']) && $_SESSION['errors']['login_success'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php $_SESSION['errors']['login_success'];
            unset($_SESSION['errors']['login_success']);
        ?>
    </div>
<?php endif; ?>

<div class="col-md-12">
    <h1>Page d'accueil</h1>
    <?php if(!empty($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3><a href=<?= URL . '/post/' . $post->id; ?>><?= $post->title; ?></a></h3>
                    <span class="lead"><strong>SYNOPSIS : </strong><?=  $post->abstract; ?></span>
                </div>
            </div>
            </br>
        <?php endforeach; ?>
    <?php else : ?>
        <p><span>Il n'y pas d'épisodes enregistés sur le site</span></p>
    <?php endif; ?>
</div>

<?php /* var_dump($_SESSION) */?>
