<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href=<?= URL; ?>>Accueil</a></li>
                <li><a href="#">A propos</a></li>
                <?php if(!isset($_SESSION['user'])) :?>
                    <li><a href=<?= URL . '/register'; ?>>S'inscrire</a></li>
                    <li><a href=<?= URL . '/login'; ?>>Connexion</a></li>
                <?php else: ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if($_SESSION['user']['role'] === 'admin') :?>
                    <li><a href=<?= URL . '/admin/dashboard'; ?>>Dashboard</a></li>
                <?php endif; ?>
                <li><a href=<?= URL . '/account'; ?>><?= $_SESSION['user']['pseudo'] ?></a></li>
                <li><a href=<?= URL . '/logout'; ?>>Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">




