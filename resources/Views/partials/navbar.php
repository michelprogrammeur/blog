
<nav>
    <ul class="nav">
        <li class="active"><a href=<?php echo URL; ?>>Accueil</a></li>
        <li><a href="#">A propos</a></li>

        <?php if(!isset($_SESSION['user'])) :?>
            <li><a href=<?php echo URL . '/register'; ?>>S'inscrire</a></li>
            <li><a href=<?php echo URL . '/login'; ?>>Connexion</a></li>
        <?php else: ?>
            <?php if($_SESSION['user']['role'] === 'admin') :?>
                <li><a href=<?php echo URL . '/admin/dashboard'; ?>>Dashboard</a></li>
            <?php endif; ?>
            <li><a href=<?php echo URL . '/account'; ?>><?= $_SESSION['user']['pseudo'] ?></a></li>
            <li><a href=<?php echo URL . '/logout'; ?>>Déconnexion</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">