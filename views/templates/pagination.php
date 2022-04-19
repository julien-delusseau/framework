<div class="d-flex justify-content-between">
    <?php if ($currentPage > 1): ?>
        <a class="btn btn-warning text-uppercase"
           href="<?= $currentPage === "2" ? URL : URL . '/admin/'.$buttons.'&page=' . ($currentPage - 1) ?>">&laquo; Plus récents</a>
    <?php endif ?>

    <?php if ($currentPage < $pages): ?>
        <a class="btn btn-warning text-uppercase ms-auto"
           href="<?= URL . '/admin/'.$buttons.'&page=' . ($currentPage + 1) ?>">Plus ancients &raquo;</a>
    <?php endif ?>
</div>