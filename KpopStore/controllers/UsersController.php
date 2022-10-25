<?php

namespace Controllers;

class UsersController {

    public function displayUsers() {

         $model = new \Models\Users();
         $users = $model->getAllUsers();

        require_once('config/config.php');
        $template = "views/listUser.phtml";
        include_once 'views/layout.phtml';

    }

    public function formSignIn() {

        require_once('config/config.php');
        $template = "views/connexion.phtml";
        include_once 'views/layout.phtml';

    }

    // public function addUsers(){

    //     $template = "views/addArticles.phtml";
    //     include_once 'views/layout.phtml';

    // }

}