<div class="container-fluid py-4">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Recherche</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <form method="post" class="ms-md-auto pe-md-3 d-flex align-items-center input-group-outline">
                    <div class="input-group">
                        <input placeholder="Recherche par titre" name="title" type="text" class="form-control">
                    </div>
                    <button type="submit" class="border-0"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="<?= URL . '/admin/posts' ?>" class="btn btn-link mb-0">Reset</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Les articles</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Auteur
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Titre de l'article
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Date de publication
                                </th>
                                <th class="text-secondary opacity-7" colspan="2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img style="object-fit: cover"
                                                     src="<?= URL . '/public/assets/uploads/' . $post->user_image ?? URL . '/public/assets/img/default_avatar.jpg' ?>"
                                                     class="avatar avatar-sm me-3 border-radius-lg" alt="">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <?php if ($post->userID === $_SESSION['user']['id']): ?>
                                                    <a href="<?= URL ?>/user/profil">
                                                        <h6 class="mb-0 text-sm"><?= $post->firstname . " " . $post->lastname ?></h6>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= URL ?>/user/filter/<?= strtolower($post->firstname) . "-" . strtolower($post->lastname) ?>">
                                                        <h6 class="mb-0 text-sm"><?= $post->firstname . " " . $post->lastname ?></h6>
                                                    </a>
                                                <?php endif ?>
                                                <p class="text-xs text-secondary mb-0"><?= $post->user_email ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?= URL . "/" . $post->slug ?>">
                                            <p class="text-xs font-weight-bold mb-0"><?= $post->title ?></p>
                                        </a>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $post->date ?></span>
                                    </td>
                                    <td class="align-middle text-center d-flex justify-content-around">
                                        <a href="<?= URL ?>/post/update/<?= $post->slug ?>" class="text-secondary font-weight-bold text-xs">
                                            <span class="btn btn-sm bg-gradient-success">Editer</span>
                                        </a>
                                        <form action="<?= URL . '/admin/deletepost/' . $post->post_id ?>" method="post"
                                              onsubmit="return confirm('Supprimer cet article ?')">
                                            <button class="btn btn-sm bg-gradient-primary" type="submit">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           <?php require_once ROOT . '/views/templates/pagination.php'?>
        </div>
    </div>
</div>
