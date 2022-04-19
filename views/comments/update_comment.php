<!-- Modals -->
<div class="modal fade" id="updateModal-<?= $comment->comment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier ce commentaire</h5>
                <button title="Fermer" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= URL . '/comment/update/' . $comment->comment_id ?>">
                <div class="modal-body">
                    <div class="form-floating">
                    <textarea class="form-control" id="content"
                              name="content"><?= $comment->content ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>