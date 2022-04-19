<?php
if (isset($_SESSION["FLASH_MESSAGE"])) {
    foreach ($_SESSION["FLASH_MESSAGE"] as $flash) {
        echo '<div class="alert alert-' . $flash["type"] . '" role="alert">' . $flash["message"] . '</div>';
        unset($_SESSION["FLASH_MESSAGE"]);
    }
}
?>

<div class="well">
    <div class="centered">
        <img class="default-avatar"
             src="<?= !empty($profil->image) ? URL . '/public/assets/uploads/' . $profil->image : URL . '/public/assets/img/default_avatar.jpg' ?>"
             alt="Avater de l'utilisateur">
        <h4><?= $profil->firstname . ' ' . $profil->lastname ?></h4>
        <div class="dotted_line">
        </div>
        <p>
            <?= !empty($profil->description) ? nl2br($profil->description) : "Pas de description pour le moment" ?>
        </p>
    </div>
</div>

<?php if ($profil->role === "ROLE_AUTHOR" || $profil->role === "ROLE_ADMIN"): ?>

    <h2 style="color: #94c045">Mes derniers articles publiés</h2>
    <hr>

    <?php if (empty($articles)): ?>
        <div class="post-heading">
            <h3>Pas d'articles publiés à ce jour.</h3>
        </div>
    <?php else: ?>
        <?php
        foreach ($articles as $article) {
            require ROOT . '/views/posts/post_item.php';
        }
        ?>
    <?php endif; ?>

<?php endif; ?>