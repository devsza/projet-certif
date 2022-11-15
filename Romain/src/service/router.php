<?php

require_once dirname(__DIR__) . "/Controller/HomeController.php";
require_once dirname(__DIR__) . "/Controller/UserController.php";
require_once dirname(__DIR__) . "/Controller/CharacterController.php";
require_once dirname(__DIR__) . "/Controller/ContactController.php";
require_once dirname(__DIR__) . "/Controller/GalleryController.php";


/**
 * Constant stockant le routing de l'application, si on veut rajouter une url c'est ici
 */
const ROUTING = [
    "home" => [
        "controller" => "HomeController",
        "action" => "index",
        "title" => "home"
    ],
    "character" => [
        "controller" => "CharacterController",
        "action" => "charactersheet",
        "title" => "character"
    ],
    "character_show" => [
        "controller" => "CharacterController",
        "action" => "show",
        "title" => "character_show"
    ],
    "character_add" => [
        "controller" => "CharacterController",
        "action" => "add",
        "title" => "character_add"
    ],
    "character_deleted" => [
        "controller" => "CharacterController",
        "action" => "deleted",
        "title" => "character_deleted"
    ],
    "character_update" => [
        "controller" => "CharacterController",
        "action" => "update",
        "title" => "character_update"
    ],
    "user_add" => [
        "controller" => "UserController",
        "action" => "add",
        "title" => "user_add"
    ],
    "user_connexion" => [
        "controller" => "UserController",
        "action" => "connexion",
        "title" => "user_connexion"
    ],
    "user_disconnect" => [
        "controller" => "UserController",
        "action" => "disconnect",
        "title" => "user_disconnect"
    ],
    "contact" =>[
        "controller"=> "ContactController",
        "action" => "index", 
        "title" => "contact"
    ],
        
    "submitForm" =>[
        "controller" => "CharacterController",
        "action" => "add", 
        "title" => "form"
    ],
        
    "deleted" =>[
        "controller" => "CharacterController",
        "action" => "deleted", 
        "title" => "deletd"
    ],
        
    "gallery" =>[
        "controller" => "GalleryController",
        "action" => "index", 
        "title" => "gallery"
    ],
];  

/**
 * function vérifiant l'existence d'une page avant d'instancier le bon controleur définie dans ROUTING
 */
function getRouteFromUrl():void
{
    $path = ROUTING["home"];
    if (isset($_GET["page"]) && isset(ROUTING[$_GET["page"]])) {
        $path =   ROUTING[$_GET["page"]];
    }
    
    $controller = new $path['controller'];
    $controller->{$path['action']}();
}

function getPageTitle(){
    $page = $_GET['page'] ?? 'home';
    return ROUTING[$page]['title'];
}

function getPageDescription(){
    $page = $_GET['page'] ?? 'home';
    return ROUTING[$page]['description'];
}
?>
