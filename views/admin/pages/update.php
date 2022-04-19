<section>
    <div class="page-header min-vh-100">
        <div class="container">
            <div class="card card-plain">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Modifier cet utilisateur</h4>
                    <p class="mb-0"><?= $profil->firstname . ' ' . $profil->lastname ?></p>
                </div>
                <div class="card-body">
                    <form role="form" method="post">
                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" id="firstname" type="text" name="firstname"
                                   value="<?= $profil->firstname ?? 'Le prénom' ?>"/>
                            <small class="text-danger"><?= $firstnameError ?? null ?></small>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" id="lastname" type="text" name="lastname"
                                   value="<?= $profil->lastname ?? 'Le nom' ?>"/>
                            <small class="text-danger"><?= $lastnameError ?? null ?></small>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" id="email" type="email" name="email"
                                   value="<?= $profil->email ?? "Adresse Email" ?>"/>
                            <small class="text-danger"><?= $emailError ?? null ?></small>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <textarea class="form-control" id="description" rows="10"
                                      name="description"><?= $profil->description ?? "Description" ?></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>