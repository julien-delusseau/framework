<!-- Modals -->
<div class="modal fade" id="deleteModal-<?= $comment->comment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer ce commentaire</h5>
                <button title="Fermer" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= URL . '/comment/delete/' . $comment->comment_id ?>">
                <div class="modal-body">
                    <p>Attention, cette opération est définitive!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-danger">Je suis sûr</button>
                </div>
            </form>
        </div>
    </div>
</div>