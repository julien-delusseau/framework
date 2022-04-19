<?php
if (isset($_SESSION["FLASH_MESSAGE"])) {
    foreach ($_SESSION["FLASH_MESSAGE"] as $flash) {
        echo '<div class="alert alert-' . $flash["type"] . '" role="alert">' . $flash["message"] . '</div>';
        unset($_SESSION["FLASH_MESSAGE"]);
    }
}
?>

<!-- start article full post -->
<article class="blog-post">
    <div class="post-heading">
        <h3><a href="#"><?= $article->title ?></a></h3>
    </div>
    <div class="clearfix">
    </div>
    <img style="max-height: 300px" src="<?= $article->post_image ?>" alt=""/>

    <?php if($_SESSION['user']['id'] === $article->author_id || isGranted('admin')): ?>
        <div class="mb-2 row">
            <div class="span2">
                <a href="<?= URL . '/post/update/' . $article->slug ?>" class="btn btn-warning">Editer cet article</a>
            </div>
            <div class="span2">
                <form action="<?= URL . '/post/delete' ?>" method="post" onsubmit="return confirm('Supprimer cet article ?')">
                    <input type="hidden" name="postId" value="<?= $article->postID ?>">
                    <button class="btn btn-danger">Supprimer cet article</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <ul class="post-meta">
        <li class="first"><i class="fa-solid fa-calendar-days"></i><span><?= $article->date ?></span></li>
        <li><i class="fa-solid fa-list"></i><span><?= $article->comments ?> commentaire(s)</span></li>
        <li class="last"><i class="fa-solid fa-user-pen"></i><span><a
                        href="#"><?= $article->firstname . ' ' . $article->lastname ?></a></span></li>
    </ul>
    <div class="clearfix">
    </div>
    <p>
        <?= html_entity_decode($article->content) ?>
    </p>
</article>
<!-- end article full post -->
<?php if (!empty($comments)): ?>
    <h4>Commentaires</h4>
    <ul class="media-list">
        <?php
        foreach ($comments as $comment) {
            require ROOT . '/views/comments/comment_item.php';
        }
        ?>
    </ul>
<?php endif;

require_once ROOT . '/views/comments/add_comment.php';
