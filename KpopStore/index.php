<?php

session_start();

// http://localhost/xampp/sarprograms/KpopStore/index.php?road=home


spl_autoload_register(function($class) {
    require_once lcfirst(str_replace('\\','/', $class)) . '.php';
});

if(array_key_exists("road", $_GET)){
    switch($_GET['road']){

        case 'home':
            $controller = new Controllers\HomeController();
            $controller->display();
            break;

        case'articles':
            $controller = new Controllers\ArticlesController();
            $controller->display();
            break;

        case 'home':
            $controller = new Controllers\HomeController();
            $controller->display();
            break;

        case 'albums':
            $controller = new Controllers\ArticlesController();
            $controller->displayAlbums();
            break;

        case 'vinyles':
            $controller = new Controllers\ArticlesController();
            $controller->displayVinyles();
            break;

        case 'artistes':
            $controller = new Controllers\ArticlesController();
            $controller->displayArtists();
            break;

        case'addArticles':
            $controller = new Controllers\ArticlesController();
            $controller->addform();
            break;
        
        case 'Add':
            $controller = new Controllers\ArticlesController();
            $controller->addArticle();
            break;

        case 'AddArtist':
            $controller = new Controllers\ArticlesController();
            $controller->addArtist();
            break;

        case'users':
            $controller = new Controllers\UsersController();
            $controller->displayUsers();
            break;

        case'basket':
            $controller = new Controllers\BasketController();
            $controller->displayBasket();
            break;

        case'signIn':
            $controller = new Controllers\UsersController();
            $controller->formSignIn();
            break;
    
        default:
            header("location: index.php?road=home");
            exit;
            break;
    }
}
else{
    header("location: index.php?road=home");
    exit;
}
