<?php

require_once dirname(__DIR__) . "/Repository/UserRepository.php";
require_once dirname(__DIR__) . "/Repository/CharacterRepository.php";
class Service
{
    /**
     * @return bool
     */
    public static function checkIfUserIsConnected(): bool
    {
        $userIsConnected = false;

        $userRepository = new UserRepository();

        if(
            isset($_SESSION["user_is_connected"], $_SESSION["user_id"])
            && $_SESSION["user_is_connected"]
            && $userRepository->find(intval($_SESSION["user_id"]))
        ) {
            $userIsConnected = true;
        }

        return $userIsConnected;

    }
   
    public static function moveFile(array $file): ?string
    {
        $file_path_image = null;
        $folder = dirname(__DIR__, 2) . "/public/assets/image/upload/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $filename = self::renameFile($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $folder . $filename)) {
            $file_path_image = $filename;
        }
        return $file_path_image;
    }

    /*fonction qui renommme l'image avec la date a la quelle elle a etait telecharger*/
    private static function renameFile(string $filename): string
    {
        $array = explode(".", $filename);
        return (new DateTime("now"))->format("Ymdhis") . "." . end($array);
    }

}