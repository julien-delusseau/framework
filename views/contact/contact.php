<?php echo GOOGLE_MAP ?>
<div class="spacer30"></div>

<?php
if (isset($_SESSION["FLASH_MESSAGE"])) {
    foreach ($_SESSION["FLASH_MESSAGE"] as $flash) {
        echo '<div class="alert alert-'.$flash["type"].'" role="alert">'.$flash["message"].'</div>';
        unset($_SESSION["FLASH_MESSAGE"]);
    }
}
?>
<div id="errormessage"></div>
<form action="<?= URL ?>/pages/contact" method="post" role="form" class="contactForm">
    <div class="row">
        <div class="span4 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Votre nom" />
            <div class="validation"><?= $nameError ?? null ?></div>
        </div>

        <div class="span4 form-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" />
            <div class="validation"><?= $emailError ?? null ?></div>
        </div>
        <div class="span8 form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Le sujet de votre message" />
            <div class="validation"><?= $subjectError ?? null ?></div>
        </div>
        <div class="span8 form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Votre message"></textarea>
            <div class="validation"><?= $messageError ?? null ?></div>
            <div>
                <button class="btn btn-color btn-rounded" type="submit">Envoyer</button>
            </div>
        </div>
    </div>
</form>