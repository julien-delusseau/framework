<?php if (isLoggedIn()): ?>
    <div class="comment-post">
        <h4>Écrire un commentaire</h4>
        <form action="<?= URL ?>/comment" method="post" class="comment-form" name="comment-form">
            <input type="hidden" name="slug" value="<?= $article->slug ?>">
            <div class="row">
                <div class="span8">
                    <label>Commentaire <span>*</span></label>
                    <textarea name="content" rows="9" class="input-block-level"
                              placeholder="Votre commentaire"></textarea>
                    <button class="btn btn-small btn-success" type="submit">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
<?php else: ?>
    <h4>Merci de vous connecter pour écrire un commentaire</h4>
<?php endif; ?>