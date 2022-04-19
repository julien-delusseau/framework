<h2>Création de votre compte</h2>

<form method="post" id="contactForm">
    <div class="form-floating">
        <label for="firstname">Votre prénom</label>
        <input class="form-control" id="firstname" type="text" name="firstname" value="<?= $firstname ?? null ?>" />
        <small class="text-danger"><?= $firstnameError ?? null ?></small>
    </div>
    <div class="form-floating">
        <label for="lastname">Votre nom</label>
        <input class="form-control" id="lastname" type="text" name="lastname" value="<?= $lastname ?? null ?>" />
        <small class="text-danger"><?= $lastnameError ?? null ?></small>
    </div>
    <div class="form-floating">
        <label for="email">Votre email</label>
        <input class="form-control" id="email" type="email" name="email" value="<?= $email ?? null ?>" />
        <small class="text-danger"><?= $emailError ?? null ?></small>
    </div>
    <div class="form-floating">
        <label for="password">Votre mot de passe (6 caratères au minimum)</label>
        <input class="form-control" id="password" type="password" name="password" />
        <small class="text-danger"><?= $passwordError ?? null ?></small>
    </div>
    <div class="form-floating">
        <label for="confirm">Confirmez votre mot de passe</label>
        <input class="form-control" id="confirm" type="password" name="confirm" />
        <small class="text-danger"><?= $confirmError ?? null ?></small>
    </div>
    <div class="mt-3">
        <label>Vous vous inscrivez en tant que :</label>
        <label class="checkbox inline">
            <input style="margin: 0" type="radio" name="role" value="ROLE_USER" checked> Lecteur
        </label>
        <label class="checkbox inline">
            <input style="margin: 0" type="radio" name="role" value="ROLE_AUTHOR"> Auteur
        </label>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-color btn-rounded" id="submitButton" type="submit">
        Envoyer
    </button>
</form>