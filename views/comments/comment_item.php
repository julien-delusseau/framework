<li class="media">
    <a class="pull-left" href="#">
        <img class="media-object avatar-comment"
             src="<?= !empty($comment->image) ? URL . '/public/assets/uploads/' . $comment->image : URL . '/public/assets/img/default_avatar.jpg' ?>"
             alt=""/>
    </a>
    <div class="media-body">
        <h5 class="media-heading"><a href="#"><?= $comment->firstname . ' ' . $comment->lastname ?></a></h5>
        <span>Le <?= $comment->date ?></span>
        <p>
            <?= nl2br($comment->content) ?>
        </p>
        <?php if(isLoggedIn()): ?>
            <?php if($comment->user_id === $_SESSION['user']['id'] || isGranted('admin')): ?>
                <div style="display: flex; align-items: center">
                    <a class="show-form" href="#">Modifier</a>
                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')" style="margin: 0 0 0 10px;" action="<?= URL . '/comment/delete/' . $comment->comment_id ?>" method="post"
                          class="comment-form delete-comment-form" name="comment-form">
                        <button class="btn-borderless text-danger" type="submit">Supprimer</button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <form action="<?= URL . '/comment/update/' . $comment->comment_id ?>" method="post"
          class="comment-form update-comment-form" name="comment-form">
        <div class="row">
            <div class="span8">
                <label>Commentaire <span>*</span></label>
                <textarea name="content" rows="9" class="input-block-level"
                          placeholder="Votre commentaire"><?= $comment->content ?></textarea>
                <button class="btn btn-small btn-success" type="submit">Envoyer</button>
                <button class="btn btn-small btn-link hide-form" type="button">Annuler</button>
            </div>
        </div>
    </form>
</li>