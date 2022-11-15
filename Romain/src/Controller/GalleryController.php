<?php

require_once dirname(__DIR__,2) . "/lib/Controller/AbstractController.php";

class GalleryController extends AbstractController {

    public function index():string {

        return $this->renderView("/template/gallery/gallery_base.php");

    }
}
