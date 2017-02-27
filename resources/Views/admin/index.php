<h1>Page dashboard admin</h1>

<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'admin') {
        echo "Bienvenu " . $_SESSION['user']->pseudo . " vous êtes connecté en temps que " . $_SESSION['user']->role;
    }
} ?>
