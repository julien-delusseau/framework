<?php if(empty($articles)): ?>
    <div class="post-heading">
        <h3>Pas d'articles publiés à ce jour.</h3>
    </div>
<?php else: ?>
    <?php
    foreach ($articles as $article) {
        require ROOT . '/views/posts/post_item.php';
    }
    ?>

    <?php if (isset($currentPage) && isset($pages)): ?>
        <div style="display: flex; align-items: center; justify-content: space-between">
            <?php if ($currentPage > 1): ?>
                <a class="btn btn-flat btn-color"
                   href="<?= $currentPage === "2" ? URL : URL . '?page=' . $currentPage - 1 ?>">&laquo; Articles récents</a>
            <?php endif ?>

            <?php if ($currentPage < $pages): ?>
                <a style="margin-left: auto" class="btn btn-flat btn-color"
                   href="<?= URL . '?page=' . $currentPage + 1 ?>">Articles
                    ancients &raquo;</a>
            <?php endif ?>
        </div>
    <?php endif; ?>
<?php endif; ?>