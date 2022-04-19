<section>
    <div class="page-header">
        <div class="container">
            <div class="card card-plain">
                <div class="card-header">
                    <h4 class="font-weight-bolder"><?= $title ?></h4>
                    <p class="mb-0">Remplissez le formulaire afin de modifier cette catégorie</p>
                </div>
                <div class="card-body">
                    <form role="form" method="post">

                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" type="text" name="name"
                                   value="<?= $category->name ?? 'La désignation de la catégorie' ?>"/>
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