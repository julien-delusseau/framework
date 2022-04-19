<section>
    <div class="page-header">
        <div class="container">
            <div class="card card-plain">
                <div class="card-header">
                    <h4 class="font-weight-bolder"><?= $title ?></h4>
                    <p class="mb-0">Remplissez le formulaire afin de modifier ce commentaire</p>
                </div>
                <div class="card-body">
                    <form role="form" method="post">

                        <div class="input-group input-group-outline mb-3">
                           <textarea class="form-control" rows="10"
                                     name="content"><?= $comment->content ?></textarea>
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