<form action="" method="post" role="form" class="postForm">
    <div class="row">
        <div class="span8 form-group">
            <input type="text" name="title" class="form-control" id="title" placeholder="Le titre de l'article" />
            <div class="validation"></div>
        </div>

        <div class="span8 form-group">
            <input type="url" class="form-control" name="image" id="image" placeholder="L'image de l'article" />
            <div class="validation"></div>
        </div>
        <div class="span4 form-group">
            <select class="form-control" name="category" id="category">
                <option hidden value="null">Merci de choisir une catégorie</option>
                <?php foreach (getCategories() as $category): ?>
                    <option value="<?= $category->id ?>"><?= ucwords($category->name) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="validation"></div>
        </div>
        <div class="span8 form-group">
                <textarea id="article-editor" name="content" rows="5" placeholder="Le contenu de l'article"></textarea>
            <div class="validation"></div>
            <div class="text-center">
                <button class="btn btn-color btn-rounded" type="submit">Créer l'article</button>
            </div>
        </div>
    </div>
</form>