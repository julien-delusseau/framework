<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <?php foreach ($articles as $article): ?>
                <?php require ROOT . '/views/posts/post_item.php'?>
            <?php endforeach ?>
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Articles ancients &raquo;</a></div>
        </div>
    </div>
</div>