<?php include __DIR__ .'/../../resources/Views/partials/header.php';

if (isset($_SESSION['errors']['login_success']) && $_SESSION['errors']['login_success'] != "") {
    echo "<p class='success'>" . $_SESSION['errors']['login_success'] . "</p>";
    unset($_SESSION['errors']['login_success']);
}

?>


<h1>Page d'accueil</h1>

<?php foreach ($posts as $post) : ?>
    <div id="billet">
        <h3><a href=<?php echo URL . '/post/' . $post->id; ?>><?php echo $post->title; ?></a></h3>
        <p><?php echo $post->content; ?></p>
    </div>
    </br>
<?php endforeach; ?>
<?php var_dump($_SESSION) ?>
