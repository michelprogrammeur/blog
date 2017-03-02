<?php if(!empty($_SESSION['errors'])): ?>
    <div>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <ul>
                <li><?php echo $error; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

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
