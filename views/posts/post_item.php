<!-- start article 1 -->
<article class="blog-post">
    <div class="post-heading">
        <h3><a href="<?= URL . '/' . $article->slug ?>"><?= $article->title ?></a></h3>
    </div>
    <div class="row">
        <div class="span3">
            <div class="post-image">
                <a href="<?= URL . '/' . $article->slug ?>"><img src="<?= $article->post_image ?>" alt=""/></a>
            </div>
        </div>
        <div class="span5">
            <ul class="post-meta">
                <li class="first"><i class="fa-solid fa-calendar-days"></i><span><?= $article->date ?></span></li>
                <li><i class="fa-solid fa-list"></i><span><?= $article->comments ?> commentaire(s)</span></li>
                <li>
                    <i class="fa-solid fa-user-pen"></i>
                    <span>
                            <a href="<?php
                            if (isLoggedIn() && $article->userID === $_SESSION['user']['id']) {
                                echo URL . '/user/profil';
                            } else {
                                echo URL . '/user/filter/' . strtolower($article->firstname) . '-' . strtolower($article->lastname);
                            }
                            ?>">
                                <?= $article->firstname . ' ' . $article->lastname ?>
                            </a>
                        </span>
                </li>
                <li class="last">
                    <i class="fa-solid fa-tags"></i><span>
                            <a href="<?= URL . '/category/filter/' . $article->category_name ?>">
                                <?= ucwords($article->category_name) ?>
                            </a>
                        </span>
                </li>
            </ul>
            <div class="clearfix">
            </div>
            <p>
                <?php
                if (strlen($article->content) > 300) echo substr(html_entity_decode($article->content), 0, 200) . '...';
                else echo html_entity_decode($article->content);
                ?>
            </p>
            <a href="<?= URL . '/' . $article->slug ?>" class="btn btn-small btn-success" type="button">Voir
                l'article</a>
        </div>
    </div>
</article>