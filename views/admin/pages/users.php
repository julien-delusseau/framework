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
                        <input placeholder="Recherche par nom" name="lastname" type="text" class="form-control">
                    </div>
                    <button type="submit" class="border-0"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="<?= URL . '/admin/users' ?>" class="btn btn-link mb-0">Reset</a>
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
                        <h6 class="text-white text-capitalize ps-3">Les utilisateurs</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nom
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Role
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Date de création
                                </th>
                                <th class="text-secondary opacity-7" colspan="2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <img style="object-fit: cover"
                                             src="<?= !empty($user->image) ? URL . '/public/assets/uploads/' . $user->image : URL . '/public/assets/img/default_avatar.jpg' ?>"
                                             class="avatar avatar-sm me-3 border-radius-lg" alt="">
                                    </td>
                                    <td>
                                        <?php if ($user->id === $_SESSION['user']['id']): ?>
                                            <a href="<?= URL ?>/user/profil">
                                                <h6 class="mb-0 text-sm"><?= $user->firstname . " " . $user->lastname ?></h6>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= URL ?>/user/filter/<?= strtolower($user->firstname) . "-" . strtolower($user->lastname) ?>">
                                                <h6 class="mb-0 text-sm"><?= $user->firstname . " " . $user->lastname ?></h6>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="mailto:<?= $user->email ?>"
                                           class="text-xs text-secondary mb-0"><?= $user->email ?></a>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-xs text-secondary mb-0">
                                            <?php
                                            if ($user->role === "ROLE_ADMIN") echo "Administrateur";
                                            elseif($user->role === "ROLE_AUTHOR") echo "Auteur";
                                            else echo "Lecteur";
                                            ?>
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= $user->created_at ?></p>
                                    </td>
                                    <td class="align-middle text-center d-flex justify-content-around">
                                        <a href="<?= URL ?>/admin/update/<?= $user->id ?>"
                                           class="text-secondary font-weight-bold text-xs">
                                            <span class="btn btn-sm bg-gradient-success">Editer</span>
                                        </a>
                                        <form action="<?= URL ?>/admin/deleteuser/<?= $user->id ?>" method="post"
                                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
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
