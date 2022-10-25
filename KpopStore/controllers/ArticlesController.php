<?php

namespace Controllers;

class ArticlesController {

    public function display() {

        $model = new \Models\Articles();
        $articles = $model->getAllArticles();

        require_once('config/config.php');
        $template = "views/allArticles.phtml";
        include_once 'views/layout.phtml';
    }

    public function displayAlbums() {

        $model = new \Models\Articles();
        $albums = $model->getAllAlbums();

        require_once('config/config.php');
        $template = "views/allAlbums.phtml";
        include_once 'views/layout.phtml';
    }

    public function displayVinyles() {

        $model = new \Models\Articles();
        $vinyles = $model->getAllVinyles();

        require_once('config/config.php');
        $template = "views/allVinyles.phtml";
        include_once 'views/layout.phtml';
    }

    public function displayArtists(){
        
        $model = new \Models\Articles();
        $artists = $model->getAllArtists();

        require_once('config/config.php');
        $template = "views/allArtists.phtml";
        include_once 'views/layout.phtml';
    }

    public function addform(){

        $model = new \Models\Articles();
        $artists = $model->getAllArtists();
        $articles = $model->getAllArticles();
        $categories = $model->getAllCategory(); 
        $catsArtist = $model->getAllCategoryArtist();

        $template = "views/addArticles.phtml";
        include_once 'views/layout.phtml';

        
    }

    public function addArticle(){

        $model = new \Models\Articles();
        $artists = $model->getAllArtists();
        $articles = $model->getAllArticles();
        $categories = $model->getAllCategory();
        $catsArtist = $model->getAllCategoryArtist();

       
        $addArticle = [
            'addProductName'        => '',
            'addProductArtist'      => '',
            'addPrice'              => '',
            'addQuantity'           => '',
            'addProductCategory'    => '',
            'addImg'                => ''
        ];

        $model = new \Models\Other();

        $data = [
            $addArticle['addProductName'],
            $addArticle['addProductArtist'],
            $addArticle['addPrice'],
            $addArticle['addQuantity'],
            $addArticle['addProductCategory'],
            $model->dataCleansing($addArticle['addImg']), // On oublie pas de nettoyer le nom de l'image !

        ];

        if(array_key_exists('product_name', $_POST) && array_key_exists('price', $_POST)
        && array_key_exists('artist_name', $_POST) && array_key_exists('categoryProduct', $_POST)
        && array_key_exists('quantity', $_POST)) {

            $Add = [
                'addProductName'        => $model->dataCleansing($_POST(['product_name'])),
                'addProductArtist'      => $model->dataCleansing($_POST(['product_artist'])),
                'addPrice'              => $model->dataCleansing($_POST(['price'])),
                'addQuantity'           => $model->dataCleansing($_POST(['quantity'])),
                'addProductCategory'    => $model->dataCleansing($_POST(['product_category']))
                // 'addImg'            => 'noImg.png'
            ]; 
        }

        if(isset($_FILES['product_img']) && $_FILES['product_img']['name'] != '') {
            $dossier = "img_Of_Articles";
            $model = new \Models\Other();
            $addArticle['addImg'] = $model->upload($_FILES['product_img'], $dossier, $errors);
        }
        
        $add = new \Models\Articles();
        $addMore = $add->addNewArticle($data);


        $msg ="L'article a bien été ajouté :)";
        $confirm = new \Models\Other();
        $validated = $confirm->alert($msg);


        var_dump($_POST);
        var_dump($_FILES);

        require_once('config/config.php');
        $template = "views/addArticles.phtml";
        include_once 'views/layout.phtml';

    }

    public function addArtist(){

        $addArtist = [
            'addArtistName'         => '',
            'addCategoryArtist'     => ''
        ];


        $data = [
                
                    $addArtist['addArtistName'],
                    $addArtist['addCategoryArtist']
                ];

        
                $model = new \Models\Other();

        if(array_key_exists('artist_name', $_POST) && array_key_exists('artist_category', $_POST)){

            $Add = [
                'addArtistName'         => $model->dataCleansing($_POST['artist_name']),
                'addCategoryArtist'     => $model->dataCleansing($_POST['artist_category']),
            ];

        }

        // $Add = new \Models\Articles();
        // $addMore = $Add->addNewArtist($data);


    }
}