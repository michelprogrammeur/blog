<h1>Liste des Commentaires signalés</h1>
<?php if(!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>
        <div id="comment-report">
            <p><?php echo $comment->author; ?></p>
            <p><?php echo $comment->content; ?></p>

            <form action="<?php echo URL . '/admin/comment/' . $comment->id . "/delete"; ?>" method="post">
                <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer ce commentaire');">Delete</button>
            </form>

            <form action="<?php echo URL . '/admin/comment/' . $comment->id . "/restore"; ?>" method="post">
                <button type="submit">Restaurer</button>
            </form>
        </div>
        </br>
    <?php endforeach; ?>
<?php else: ?>
    <p><?php echo "Il n'y a pas de commentaires signalés"; ?></p>
<?php endif; ?>
