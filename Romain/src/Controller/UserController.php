<?php

require_once dirname(__DIR__, 2) . "/lib/Controller/AbstractController.php";
require_once dirname(__DIR__) . "/Repository/UserRepository.php";
require_once dirname(__DIR__) . "/Model/User.php";

class UserController extends AbstractController
{
    /**
     * @Route user_add
     */

   public function add()
    {
        $error = null;
        $message = "";
        // Vérification de l'eexistence des index dans $_POST
        if (
            !empty($_POST)
            &&  isset($_POST["pseudo"], $_POST["mail"], $_POST["password"])
        ) {
            $error = false;
            $message = "Erreur : Informations invalides.";
            $userRepository =  new UserRepository();

            // déclaration et assignation des variable avec vérifcation de l'existence de valeur valide
            if (
                strlen($pseudo = trim($_POST["pseudo"]))
                && strlen($mail = trim($_POST["mail"]))
                && strlen($password = trim($_POST["password"]))
            ) {
                // Vérification di un utilisateur n'existe pas déjà avec ce username
                $message = "Erreur :  l'utilisateur existe déjà.";
                if (empty($userRepository->findOneByPseudo($pseudo))) {
                    // Instanciation de User
                    $user = new User();
                    // assignation des valeur de usser
                    $user->setPseudo($pseudo);
                    $user->setMail($mail);
                    $user->setPassword(password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]));
                    // insertion du nouveau utilisateur dans la BDD
                    $userRepository->add($user);

                    // Gestion erreur
                    $error = true;
                    $message = "L'utilisateur a bien été créé.";
                }
            }
        }

        // renvoie de la vue correspondante avec des paramètres 
        return $this->renderView("/template/user/template_part/_add_form.php", [
            "error" => $error,
            "message" => $message
        ]);
    }
    /**
     * @Route user_connexion
     * fonction qui permet a l'utilisateur de se crée un profil
     * j'utilise la method findbyonepseudo qui trouve le pseudo, qui veriffie le password, check de l'utilisateur connecter, je vien recuperer son role pour savoir si il est admin ou simple utilisateur
     */

    public function connexion()
    {
        $hasError = false;
        $message = "";
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            if(empty($_POST['pseudo']) || empty($_POST['password'])) {
                $hasError = true;
                $message = "Veuillez renseigner un pseudo et un mot de passe.";
            } else {
                $userRepository = new UserRepository();
                $user = $userRepository->findOneByPseudo($_POST["pseudo"]);
                if($user === null || !password_verify($_POST["password"], $user->getPassword())) {
                    $hasError = true;
                    $message = "Le pseudo ou le mot de passe est invalide.";
                } else {
                    $hasError = false;
                    $_SESSION['user_is_connected'] = true;
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();
                    header("Location: ./?page=home");
                    exit();
                }
            }
        }
        if(array_key_exists('user_is_connected', $_SESSION) && $_SESSION['user_is_connected']) {
            $message = "Vous êtes déjà connecté.";
        }
        if($hasError || $_SERVER['REQUEST_METHOD'] !== "POST") {
            return $this->renderView("/template/user/user_connexion.php", 
                [
                    "error" => $hasError,
                    "message" => $message
                ]
            );
        } else {
            header("Location: ./?page=home");
            exit();
        }
    }

    /**
     * @Route user_disconnect
     */

     public function disconnect()
     {
        if (isset($_SESSION["user_is_connected"]) && $_SESSION["user_is_connected"]) {
            session_destroy();
            header("Location: ./?page=home");
            exit();
        }
     }


}
