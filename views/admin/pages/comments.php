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
                        <input placeholder="Recherche par contenu" name="content" type="text" class="form-control">
                    </div>
                    <button type="submit" class="border-0"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="<?= URL . '/admin/comments' ?>" class="btn btn-link mb-0">Reset</a>
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
                        <h6 class="text-white text-capitalize ps-3">Les commentaires</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Utilisateur
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Article
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Commentaire
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Création
                                </th>
                                <th class="text-secondary opacity-7" colspan="2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td>
                                        <p class="text-xs text-secondary mb-0"><?= $comment->fullname ?></p>
                                    </td>
                                    <td>
                                        <a href="<?= URL .'/'. $comment->slug ?>">
                                            <p class="text-xs text-secondary mb-0"><?= $comment->title ?></p>
                                        </a>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?php
                                            if (strlen($comment->content) > 60) {
                                                echo substr($comment->content,0 ,60) . '...';
                                            } else {
                                                echo  $comment->content;
                                            }
                                            ?>
                                        </h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= $comment->created_at ?></p>
                                    </td>
                                    <td class="align-middle text-center d-flex justify-content-around">
                                        <a href="<?= URL ?>/admin/editcomment/<?= $comment->id ?>"
                                           class="text-secondary font-weight-bold text-xs">
                                            <span class="btn btn-sm bg-gradient-success">Editer</span>
                                        </a>
                                        <form action="<?= URL ?>/admin/deletecomment/<?= $comment->id ?>" method="post"
                                              onsubmit="return confirm('Supprimer ce commentaire ?')">
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
