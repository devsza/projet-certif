<form method="post">
    <fieldset>
        <h2 class="fs-title">Connect to your account</h2>
        <input type="text" name="pseudo" placeholder="Pseudo" />
        <input type="password" name="password" placeholder="Password" />
        <input type="submit" name="submit" class="submit-action-button" value="Connexion" />
        <p>Pas de compte ?</p>
        <a href="?page=user_add">Inscription</a>
    </fieldset>

</form>

<?php if (!empty($params) && array_key_exists('error', $params) && array_key_exists('message', $params)) {
    if ($params["error"]) {
        echo $params['message'];
    } else if($params['message'] !== "") {
        echo $params['message'];
    }
}