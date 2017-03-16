<div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="display: inline-block; padding: 0 20px 0 0"><?= $comment->author; ?></h4>
            <span style="font-size: 14px" class="label label-info"><?= $comment->published_at; ?></span>
        </div>
        <div class="panel-body">
            <p><?= $comment->content; ?></p>
            <?php if(isset($_SESSION['user'])) : ?>
                <form class="text-right" id="form_comment" action="<?= URL . '/comments/report/post/' . $post->id . '/comment/' . $comment->id ?>" method="post">
                    <button class="btn btn-info reply" data-id="<?= $comment->id; ?>">Répondre</button>
                    <button class="btn btn-danger type="submit">Signaler</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<div style="margin-left: 65px;">
    <?php
    if(isset($comment->children)) {
        foreach($comment->children as $comment) {
            require('comments.php');
        }
    }
    ?>
</div>

