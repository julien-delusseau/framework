<?php
if (isset($_SESSION["FLASH_MESSAGE"])) {
    foreach ($_SESSION["FLASH_MESSAGE"] as $flash) {
        echo '<div class="alert alert-'.$flash["type"].'" role="alert">'.$flash["message"].'</div>';
        unset($_SESSION["FLASH_MESSAGE"]);
    }
}
?>

<h2>Merci de renseigner votre adresse email</h2>

<form method="post">
    <div class="form-floating">
        <label for="email">Votre email</label>
        <input class="form-control" id="email" type="email" name="email" />
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-color btn-rounded" type="submit">
        Envoyer
    </button>
</form>