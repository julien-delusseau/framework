<?php
if (isset($_SESSION["FLASH_MESSAGE"])) {
    foreach ($_SESSION["FLASH_MESSAGE"] as $flash) {
        echo '<div class="alert alert-'.$flash["type"].'" role="alert">'.$flash["message"].'</div>';
        unset($_SESSION["FLASH_MESSAGE"]);
    }
}
?>

<h2>Connectez-vous à votre compte</h2>

<form id="contactForm" method="post">
    <div class="form-floating">
        <label for="email">Votre email</label>
        <input class="form-control" id="email" type="email" name="email" />
    </div>
    <div class="form-floating">
        <label for="password">Votre mot de passe</label>
        <input class="form-control" id="password" type="password" name="password" />
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-color btn-rounded" id="submitButton" type="submit">
        Envoyer
    </button>
    <a href="<?= URL ?>/user/forgotpass">
        Mot de passe oublié ?
    </a>
</form>