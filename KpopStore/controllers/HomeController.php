<?php

namespace Controllers;

class HomeController {

    public function display() {

         $model = new \Models\Articles();
         $articles = $model->getAllArticles();

       require_once('config/config.php');
        $template = "home.phtml";
        include_once 'views/layout.phtml';
    }
}