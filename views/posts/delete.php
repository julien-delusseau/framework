<form action="<?= URL . '/post/delete' ?>" method="post" onsubmit="alert('Supprimer cet article ?')">
    <input type="hidden" name="postId" value="<?= $article->postID ?>">
    <button class="btn btn-danger text-uppercase" id="submitButton" type="submit"><i class="fa-solid fa-trash me-2"></i>Supprimer</button>
</form>