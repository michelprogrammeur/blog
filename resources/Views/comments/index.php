<?php  include __DIR__ .'/../partials/header.php';

if (isset($_SESSION['errors']['comment_restore']) && $_SESSION['errors']['comment_restore'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['comment_restore'];
            unset($_SESSION['errors']['comment_restore']);
        ?>
    </div>
<?php endif;
if (isset($_SESSION['errors']['comment_delete']) && $_SESSION['errors']['comment_delete'] != "") : ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $_SESSION['errors']['comment_delete'];
        unset($_SESSION['errors']['comment_delete']);
        ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Liste des Commentaires signalés</h1>
        <?php if(!empty($comments)) : ?>
            <?php foreach ($comments as $comment) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $comment->author; ?>
                    </div>
                    <div class="panel-body">
                        <?php echo $comment->content; ?>

                        <div class="text-right">
                            <form style="display: inline-block" action="<?php echo URL . '/admin/comment/' . $comment->id . "/delete"; ?>" method="post">
                                <button class="btn btn-danger type="submit" onclick="return confirm('Voulez vous vraiment supprimer ce commentaire');">Delete</button>
                            </form>
                            <form style="display: inline-block" action="<?php echo URL . '/admin/comment/' . $comment->id . "/restore"; ?>" method="post">
                                <button class="btn btn-primary type="submit">Restaurer</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p><?php echo "Il n'y a pas de commentaires signalés"; ?></p>
        <?php endif; ?>
    </div>
</div>
