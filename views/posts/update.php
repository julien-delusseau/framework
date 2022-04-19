<h2>Modification de l'article</h2>

<form method="post">
    <div>
        <label for="title">Le titre de l'article <sup class="text-danger">*</sup></label>
        <input class="form-control" id="title" type="text" name="title" value="<?= $articleTitle ?? null ?>" />
        <small class="text-danger"><?= $articleTitleError ?? null ?></small>
    </div>
    <div>
        <label for="image">L'image principale de l'article <sup class="text-danger">*</sup></label>
        <input class="form-control" id="image" type="url" name="image" value="<?= $image ?? null ?>" />
        <small class="text-danger"><?= $imageError ?? null ?></small>
    </div>
    <div>
        <label for="content">Le corps de l'article (100 caractères minimum) <sup class="text-danger">*</sup></label>
        <textarea class="form-control" id="article-editor"
                  name="content"><?= $content ?? null ?></textarea>
        <small class="text-danger"><?= $contentError ?? null ?></small>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-color btn-rounded" id="submitButton" type="submit">
        Envoyer
    </button>
</form>