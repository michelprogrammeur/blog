<?php include __DIR__ .'/../../resources/Views/partials/header.php'; ?>

<h1>Page d'accueil</h1>

<!-- if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'visiteur') {
        echo "Bienvenu " . $_SESSION['user']->pseudo . " vous êtes connecté en temps que " . $_SESSION['user']->role;
    }
} -->

<?php foreach ($posts as $post) : ?>
    <div id="billet">
        <p><a href=<?php echo URL . '/post/' . $post->id; ?>><?php echo $post->title; ?></a></p>
        <p><?php echo $post->content; ?></p>
    </div>
    </br>
<?php endforeach; ?>
<?php var_dump($_SESSION) ?>
