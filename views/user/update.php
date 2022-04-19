<h2>Modification du profil</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
    <div>
        <label for="firstname">Votre prénom</label>
        <input class="form-control" id="firstname" type="text" name="firstname" value="<?= $profil['firstname'] ?? null ?>" />
        <small class="text-danger"><?= $firstnameError ?? null ?></small>
    </div>
    <div>
        <label for="lastname">Votre nom</label>
        <input class="form-control" id="lastname" type="text" name="lastname" value="<?= $profil['lastname'] ?? null ?>" />
        <small class="text-danger"><?= $lastnameError ?? null ?></small>
    </div>
    <div>
        <label for="email">Votre email</label>
        <input class="form-control" id="email" type="email" name="email" value="<?= $profil['email'] ?? null ?>" />
        <small class="text-danger"><?= $emailError ?? null ?></small>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="5"
                  name="description"><?= $profil['description'] ?? null ?></textarea>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-color btn-rounded" id="submitButton" type="submit">
        Envoyer
    </button>
</form>