<!--  USERS  -->
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white ps-3">Les derniers inscrits</h6>
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
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>