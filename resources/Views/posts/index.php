<h1>Liste des épisodes</h1>

<?php foreach ($posts as $post) : ?>
    <div id="billet">
        <p><?php echo $post->title; ?></p>
        <p><?php echo $post->content; ?></p>
        <a href="<?php echo URL . '/admin/post/' . $post->id . "/edit"; ?>">Modifier</a>

        <form action="<?php echo URL . '/admin/post/' . $post->id . "/delete"; ?>" method="post">
            <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer l\'article');">Delete</button>
        </form>
    </div>
    </br>
<?php endforeach; ?>

