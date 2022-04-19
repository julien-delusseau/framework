<h2>Reset du mot de passe</h2>

<form method="post">
    <div>
        <label for="password">Votre nouveau mot de passe (6 caratères au minimum)</label>
        <input class="form-control" id="password" type="password" name="password" />
        <small class="text-danger"><?= $passwordError ?? null ?></small>
    </div>
    <div>
        <label for="confirm">Confirmez le mot de passe</label>
        <input class="form-control" id="confirm" type="password" name="confirm" />
        <small class="text-danger"><?= $confirmError ?? null ?></small>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-color btn-rounded" id="submitButton" type="submit">
        Envoyer
    </button>
</form>