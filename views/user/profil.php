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
        <a href="<?= URL ?>/user/updateimage" class="avatar">
            <img class="default-avatar"
                 src="<?= !empty($profil['image']) ? URL . '/public/assets/uploads/' . $profil['image'] : URL . '/public/assets/img/default_avatar.jpg' ?>"
                 alt="Avater de l'utilisateur">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <h4><?= $profil['firstname'] . ' ' . $profil['lastname'] ?></h4>
        <div class="dotted_line">
        </div>
        <p>
            <?= !empty($profil['description']) ? nl2br($profil['description']) : "Pas de description pour le moment" ?>
        </p>
    </div>

    <div style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap">
        <a href="<?= URL ?>/user/update">
            <span style="margin: 0 10px" class="badge badge-info">Modifier mon profil</span>
        </a>
        <a href="<?= URL ?>/user/updatepassword">
            <span style="margin: 0 10px" class="badge badge-warning">Modifier mon mot de passe</span>
        </a>
        <form class="delete-form" action="<?= URL . '/user/deleteuser/' . $profil['id'] ?>" method="post"
              onsubmit="return confirm('ATTENTION : Cette action est irréversible !')">
            <button type="submit" class="btn-borderless">
                <span style="margin: 0 10px" class="badge badge-important">Supprimer mon profil</span>
            </button>
        </form>
    </div>
</div>

<?php if (isGranted('author') || isGranted('admin')): ?>

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
