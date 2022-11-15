    <!-- multistep form -->
<form method="post"id="msform">
    <input type="text" name="pseudo" placeholder="Pseudo"/>
    <input type="text" name="mail" placeholder="Mail"/>
    <input type="password" name="password" placeholder="Mot de Passe" id="password"/>
    <input type="submit" name="submit" value="Soumettre" />
</form>

<div class="mt-3">
<?php if (isset($params["error"]) && !empty($params)) { ?>
        <?php if (!$params["error"]) { ?>
            <div class="error-message" role="alert">
                <?php echo $params["message"]; ?>
            </div>
        <?php } ?>
        <?php if ($params["error"]) { ?>
            <div class="valid-message" role="alert">
                <?php echo $params["message"]; ?>
            </div>
        <?php } ?>
    <?php } ?>

</div>