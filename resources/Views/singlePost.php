<?php include __DIR__ .'/../../resources/Views/partials/header.php'; ?>

<div id="billet">
    <p><?php echo $post->title; ?></p>
    <p><?php echo $post->content; ?></p>
</div>

<?php if(isset($_SESSION['user'])) : ?>
    <form id="comment" method="post" action=<?php echo "/blog/post/" . $post->id . "/add"; ?>>
        <div id="comment-field">
            <label>Votre commentaire</label>
            <textarea name="message" ></textarea>
        </div>
        <button type="submit">Commenter</button>
    </form>
<?php endif; ?>




<?php if(isset($comments) && !empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>
        <div id="comments">
            <p><?php echo $comment->author; ?></p>
            <p><?php echo $comment->published_at; ?></p>
            <p><?php echo $comment->content; ?></p>
            <?php if (isset($_SESSION['user'])) : ?>
                <?php if ($comment->warning !== '1') : ?>
                    <form action="<?= URL . '/comments/report/post/' . $post->id . '/comment/' . $comment->id ?>" method="post">
                        <button type="submit">Signaler</button>
                    </form>
                    <button type="submit" class="reply" data-id="<?php echo $comment->id; ?>">Répondre</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        </br>
    <?php endforeach; ?>
 <?php else: ?>
    <p><span>Cet épisode ne possède pas de commentaires</span></p>
<?php endif; ?>
