<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Les catégories</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nom de la catégorie
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nombre d'articles
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Catégorie créée le
                                </th>
                                <th class="text-secondary opacity-7" colspan="2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td>
                                        <h6 class="text-sm mb-0"><?= ucwords($category->name) ?></h6>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0"><?= $category->count ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0"><?= $category->created_at ?></p>
                                    </td>
                                    <td class="align-middle text-center d-flex justify-content-around">
                                        <a href="<?= URL ?>/admin/editcategory/<?= $category->id ?>"
                                           class="text-secondary font-weight-bold text-xs">
                                            <span class="btn btn-sm bg-gradient-success">Editer</span>
                                        </a>
                                        <form action="<?= URL ?>/admin/deleteCategory/<?= $category->id ?>" method="post"
                                              onsubmit="return confirm('ATTENTION! CETTE OPÉRATION ENTRAINERA LA SUPPRESSION DES ARTICLES ET COMMENTAIRES EN RAPPORT AVEC CETTE CATÉGORIE')">
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
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white ps-3">Ajouter une catégorie</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card-body px-0 pb-2">
                            <form role="form" method="post" action="<?= URL ?>/admin/addcategory">
                                <div class="input-group input-group-outline mb-3">
                                    <input class="form-control" type="text" name="name" />
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg bg-gradient-success btn-lg w-100 mt-4 mb-0">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
