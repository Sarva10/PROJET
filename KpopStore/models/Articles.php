<?php

namespace Models;


class Articles extends Database {

    public function getAllArticles() {
        $request = "SELECT product.product_name, artist.artist_name, product.price, category.category_name, product.product_id, product.quantity, product.created_at, product.modified_at
                    FROM product 
                    INNER JOIN category ON product.category_id = category.id
                    INNER JOIN artist ON artist.artist_id=product.artist_id
                    ORDER BY product.product_id DESC
                    LIMIT 20 ";
        return $this->findAll($request);
    }

    public function getAllAlbums(){
        $request = "SELECT *
                    FROM product
                    JOIN artist ON artist.artist_id=product.artist_id 
                    WHERE product.category_id=1";
        return $this->findAll($request);

    }

    public function getAllVinyles(){
        $request = "SELECT *
                    FROM product
                    JOIN artist ON artist.artist_id=product.artist_id  
                    WHERE product.category_id= 2";
        return $this->findAll($request);

    }

    public function getAllArtists(){
        $request = "SELECT *
                    FROM artist
                    JOIN category_artist ON artist.category_id=category_artist.category_artist_id
                    ORDER BY artist.artist_name ";
        return $this->findAll($request);
    }

    public function getAllCategory(){
        $request = "SELECT *
                    FROM category ";
        return $this->findAll($request);
    }

    public function getAllCategoryArtist(){
        $request = "SELECT *
                    FROM category_artist ";
        return $this->findAll($request);
    }


    public function getArticleById($id) {
        return $this->getOneById('articles', 'art_', $id);
    }

    public function getAllImagesById($id) {
        return $this->getAllById('imagesdetails', 'img_id_article', $id);
    }

    public function addNewArticle($data) { 
        
        // return $data->foreign('artit_id')->references('artist_id')->on('artist');
        return $this->addProduct(  'product',
                        'product_name, artist_id, category_id, price , quantity, image',
                        '?,?,?,?,?,?', 'artist_id', 'artist_id', 'artist', $data);
    }

    // public function addNewArtist($data) { 
        
    //     return $this->addProduct(  'artist',
    //                     'artist_name, category_id',
    //                     '?,?',
    //                     $data);
    // }
}
