<?php

require_once dirname(__DIR__, 2) . "/lib/Controller/AbstractController.php";
require_once dirname(__DIR__) . "/Repository/CharacterRepository.php";
require_once dirname(__DIR__) . "/Repository/UserRepository.php";
require_once dirname(__DIR__) . "/service/service.php";

class CharacterController extends AbstractController
{
    /**
     * @var CharacterController $characterRepository
     */
    private CharacterRepository $characterRepository;


    public function __construct(){
        $this->characterRepository = new CharacterRepository();
    }

    /**
     * @Route home
     * @return string utilise la methode renderView() définie dans la classe abstrait parent abstractController 
     * fonction qui apelle le characaterrepository et qui permet de trouver tous les character avec la 2e clé de la method renderview
     */
    public function charactersheet(): string
    {
        $characterRepository = new CharacterRepository();
       
        return $this->renderView("/template/character/character_base.php", 
        [
            "character" => $characterRepository->findAll()
        ]);
    }


    /**
     * @Route article_show
     * fonction qui permet de retourner un personnage en particulier que l'utilisateur a choisi grac a son id en appellant le method finf du repository avec le $_GET["character_id"]
     */
    public function show() {
        
        $characterRepository = new CharacterRepository();
        
        return $this->renderView("/template/character/character_base.php", 
        [
            "character" => $characterRepository->find($_GET['character_id'])
        ]);
        
    }
    
   /**
     * fonction qui permert d'ajouter un personnage garce userifconnected qui verifie si l'utilisateur et connecter en suite je verifie mon formulaire d'ajout et je controle les champs de mon formulaire
     * Ajout d'une method qui verifie : l'extensions, le contenu de l'image avec la method native de php mime_cotent_type, la taille du fichier 
     */
     
    public function add()
    {
        if ( Service::checkIfUserIsConnected() ) {
            $error = true;
            $message =  "";
            $characterRepository = new CharacterRepository();
            if (!empty($_POST)) {
                if (array_key_exists("name", $_POST) 
                    && array_key_exists("nationality", $_POST)
                    && array_key_exists("gender", $_POST)
                    && array_key_exists("description", $_POST)
                    && array_key_exists("difficulty", $_POST)
                    && array_key_exists("power", $_POST)
                    && array_key_exists("weapon", $_POST)
                    && array_key_exists("image", $_FILES)) {
                   if (strlen(trim($_POST["name"])) !=0 
                         &&  strlen(trim($_POST["nationality"])) !=0 
                         &&  strlen(trim($_POST["gender"])) !=0 
                         &&  strlen(trim($_POST["description"])) !=0
                         &&  strlen(trim($_POST["difficulty"])) !=0 
                         &&  strlen(trim($_POST["power"])) !=0 
                         &&  strlen(trim($_POST["weapon"])) !=0) {
                            
                                 $mime_types = array(
                                'png'   => 'image/png',
                                'jpe'   => 'image/jpeg',
                                'jpeg'  => 'image/jpeg',
                                'jpg'   => 'image/jpeg',
                        );
    
                        $extensions = [ "png", "jpeg", 'jpg', 'jpe'];
    
                        // Vérification de l'extension
                        $tmpNameArray = explode(".", $_FILES['image']["name"]);
                        $tmpExt = end($tmpNameArray);
    
    
                        // Si l'extension n'est pas dans le tableau --> error
                        if (!in_array($tmpExt, $extensions, true)) {
                           $error = false;
                           $message = "Nous n'acceptons que les fichiers aux extensions suivantes : 'png', 'jpeg',....";
                        }
    
    
                        // Vérification du contenu du fichier grace à MIME
                        if ($_FILES['image']['error'] == 0 ) {
                            if (!in_array(mime_content_type($_FILES['image']['tmp_name']), $mime_types, true) ) {
                                $error = false;
                                $message = "Il semble y avoir un probleme.";
                            }
                        } else {
                            $error = false;
                            $message = "Fichier trop volumineux.";
                        }
    
                        // Vérification de la taille ( pas plus de 2Mo ) --> voir également le fichier .ini
                        if ($_FILES['image']['size'] > 2000000) {
                            $error = false;
                            $message = "Fichier trop volumineux.";
                        }
    
                        if ($error) {


                        $file_path_image = Service::moveFile($_FILES["image"]);
                        $sheet =  new Sheet();
                        $sheet->setName(trim($_POST["name"]));
                        $sheet->setNationality(trim($_POST["nationality"]));
                        $sheet->setGender(trim($_POST["gender"]));
                        $sheet->setDescription(trim($_POST["description"]));
                        $sheet->setDifficulty(trim($_POST["difficulty"]));
                        $sheet->setPower(trim($_POST["power"]));
                        $sheet->setWeapon(trim($_POST["weapon"]));
                        $sheet->setFile_path_image($file_path_image);
                        $characterRepository->add($sheet);
                        $sheet = $characterRepository->findLast();
                        header("Location: ./?page=character");
                        exit();
                        }
                    }
                }
            } else {
                return $this->renderView("/template/character/character_add.php", [
                    "error" => $error,
                    "message" => $message,
                ]);
            }
        } else {
            header("Location: ./?page=home");
        }
    }

    /**
     * @route article_deleted
     * fonction qui sert a supprimer un personnage..
     */
    public function deleted()
    {
        $char = new CharacterRepository();
        
        
        if (Service::checkIfUserIsConnected() && isset($_GET["sheet_id"])
        ) {
            $sheet = $char->find($_GET["sheet_id"]);
           // var_dump($sheet->getFile_path_image()); die;
            //supression de l'image lier au personnage 
            unlink("assets/image/upload/". $sheet->getFile_path_image());
            //supression du personnage dans la bdd
            
            $char->deleted($sheet);
        
            header("Location: ?page=character");
            exit();  
        }
    }
    
    /**
     * fonction qui permert de modifier un personnage 
     * Ajout d'une method qui verifie : l'extensions, le contenu de l'image avec la method native de php mime_cotent_type, la taille du fichier 
     * grace a la methos find du repository j'utilise le $_GET pour récupere le personnage, je retrenscri tout ça dans mon formulaire
     * verification avec setter pour le contenu modifier du personnage
     */
     
    public function update()
    {
        $error = true;
        $message =  "";
        // Vérification de l'existence de l'article passé en paramètre d'url et déclaration, assignation de article 
        if (isset($_GET["sheet_id"])
        ) {
            $character = $this->characterRepository->find($_GET["sheet_id"]);
            // Vérification validé des data pour l'article
            if (isset($_POST)){
                
                if (array_key_exists("name", $_POST) 
                        && array_key_exists("nationality", $_POST)
                        && array_key_exists("gender", $_POST)
                        && array_key_exists("description", $_POST)
                        && array_key_exists("difficulty", $_POST)
                        && array_key_exists("power", $_POST)
                        && array_key_exists("weapon", $_POST)
                        && array_key_exists("image", $_FILES)) {
                            
                       if (strlen(trim($_POST["name"])) !=0 
                             &&  strlen(trim($_POST["nationality"])) !=0 
                             &&  strlen(trim($_POST["gender"])) !=0 
                             &&  strlen(trim($_POST["description"])) !=0
                             &&  strlen(trim($_POST["difficulty"])) !=0 
                             &&  strlen(trim($_POST["power"])) !=0 
                             &&  strlen(trim($_POST["weapon"])) !=0) {
                                 
                    $id = $_GET['sheet_id'];
                    
                    $name = trim($_POST["name"]);
                    $nationality = trim($_POST["nationality"]);
                    $gender = trim($_POST["gender"]);
                    $description = trim($_POST["description"]);
                    $difficulty = trim($_POST["difficulty"]);
                    $power = trim($_POST["power"]);
                    $weapon = trim($_POST["weapon"]);
                    
                    $file_path_image = $character->getFile_path_image();
                    
                    
                    if ( $_FILES["image"]["name"] != "")  {
                        
                        $mime_types = array(
                                'png'   => 'image/png',
                                'jpe'   => 'image/jpeg',
                                'jpeg'  => 'image/jpeg',
                                'jpg'   => 'image/jpeg',
                        );
                        
                        $extensions = [ "png", "jpeg", 'jpg', 'jpe'];
                        
                        // Vérification de l'extension
                        $tmpNameArray = explode(".", $_FILES['image']["name"]);
                        $tmpExt = end($tmpNameArray);
                        
                        
                        // Si l'extension n'est pas dans le tableau --> error
                        if (!in_array($tmpExt, $extensions, true)) {
                          $error = false;
                          $message = "Nous n'acceptons que les fichiers aux extensions suivantes : 'png', 'jpeg',....";
                        }
                        
                        
                        // Vérification du contenu du fichier grace à MIME
                        if ($_FILES['image']['error'] == 0 ) {
                            if (!in_array(mime_content_type($_FILES['image']['tmp_name']), $mime_types, true) ) {
                                $error = false;
                                $message = "Il semble y avoir un probleme.";
                            }
                        } else {
                            $error = false;
                            $message = "Fichier trop volumineux.";
                        }
                        
                        // Vérification de la taille ( pas plus de 2Mo ) --> voir également le fichier .ini
                        if ($_FILES['image']['size'] > 2000000) {
                            $error = false;                            
                            $message = "Fichier trop volumineux.";
                        
                    
                        }
                        
                    }    
                  
                    if ($error) {
                        $sheet =  new Sheet();
                        $sheet->setId($id);
                        $sheet->setName($name);
                        $sheet->setNationality($nationality);
                        $sheet->setGender($gender);
                        $sheet->setDescription($description);
                        $sheet->setDifficulty($difficulty);
                        $sheet->setPower($power);
                        $sheet->setWeapon($weapon);
                        $sheet->setFile_path_image($file_path_image);
                        
                        if ($_FILES["image"]["name"] != ""){
                            
                            if (is_file("assets/image/upload/".$sheet->getFile_path_image())) {
                                unlink("assets/image/upload/".$sheet->getFile_path_image());
                            }
        
                            $file_path_image = Service::moveFile($_FILES['image']);
                            $sheet->setFile_path_image($file_path_image);
                        }
                        
                        $this->characterRepository->update($sheet);
                        header("Location: ./?page=character");
                        exit();
                    }
                
              }
            }
            return $this->renderView(
                "/template/character/character_update.php",
                [
                    "error" => $error,
                    "message" => $message,
                    "sheet" => $character
                ]
            );
        }
    }
  }
}

