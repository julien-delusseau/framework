<!--  POSTS  -->
<div class="row mt-4 mb-2">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white ps-3">Les derniers articles</h6>
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
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>