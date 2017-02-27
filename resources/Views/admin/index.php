<?php include __DIR__ .'/../partials/header.php'; ?>

<h1>Page dashboard admin</h1>

<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'admin') {
        echo "Bienvenu " . $_SESSION['user']->pseudo . " vous êtes connecté en temps que " . $_SESSION['user']->role;
    }
} ?>

<section>
    <ul class="nav">
        <li><a href=<?php echo URL . '/admin/posts'; ?>>Liste de posts</a></li>
        <li>
            <ul>
                <li class="active"><a href=<?php echo URL . '/admin/post/create'; ?>>créer</a></li>
            </ul>
        </li>
    </ul>
</section>
