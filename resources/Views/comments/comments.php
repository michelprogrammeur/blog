<div>
    <p><?php echo $comment->author; ?></p>
    <p><?php echo $comment->published_at; ?></p>
    <p><?php echo $comment->content; ?></p>

    <?php if(isset($_SESSION['user'])) : ?>
        <form id="form_comment" action="<?= URL . '/comments/report/post/' . $post->id . '/comment/' . $comment->id ?>" method="post">
            <button type="submit">Signaler</button>
        </form>
        <button class="btn btn-default reply" data-id="<?= $comment->id; ?>">Répondre</button>
    <?php endif; ?>
</div>

<div style="margin-left: 65px;">
    <?php if(isset($comment->children)): ?>
        <?php foreach($comment->children as $comment): ?>
            <?php require('comments.php'); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

