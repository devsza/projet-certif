
<?php
$name = null;
$nationality = null;
$gender = null;
$description = null;
$difficulty = null;
$power = null;
$weapon = null;
$file_path_image = null;

if (isset($params["sheet"])) {
    $name = $params["sheet"]->getName();
    $nationality = $params["sheet"]->getNationality();
    $gender = $params["sheet"]->getGender();
    $description = $params["sheet"]->getdescription();
    $difficulty = $params["sheet"]->getDifficulty();
    $power = $params["sheet"]->getPower();
    $weapon = $params["sheet"]->getWeapon();
    $file_path_image = $params["sheet"]->getFile_path_image();
}

?>

<div>
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

<form method="post"  enctype="multipart/form-data" <?php if (!empty($name)) { echo 'action="./?page=character_update&sheet_id=' . $_GET["sheet_id"] . '"'; } ?> >
    <div>
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="<?php if (!empty($name)) echo $name; ?>">
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" value="<?php if(!empty($file_path_image)) echo $file_path_image ?>">
    </div>
    <div>
        <label for="nationality">nationality</label>
        <textarea name="nationality" id="nationality"><?php if (!empty($nationality)) echo $nationality?> </textarea>
    </div>
    <div>
        <label for="gender">gender</label>
        <textarea name="gender" id="gender"><?php if (!empty($gender)) echo $gender?> </textarea>
    </div>
    <div>
        <label for="description">description</label>
        <textarea name="description" id="description"><?php if (!empty($description)) echo $description?> </textarea>
    </div>
    <div>
        <label for="difficulty">difficulty</label>
        <textarea name="difficulty" id="difficulty"><?php if (!empty($difficulty)) echo $difficulty?> </textarea>
    </div>
    <div>
        <label for="power">power</label>
        <textarea name="power" id="power"><?php if (!empty($power)) echo $power?> </textarea>
    </div>
    <div>
        <label for="weapon">weapon</label>
        <textarea name="weapon" id="weapon"><?php if (!empty($weapon)) echo $weapon?> </textarea>
    </div>
    </div>
    <input type="submit" <?php if (!empty($name)) { echo "value='Modifier'"; } else { echo "value='Créer'"; } ?> >
</form>