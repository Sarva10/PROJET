<?php

namespace Controllers;

class BasketController {

    public function displayBasket() {

        $template = "views/basket.phtml";
        include_once 'views/layout.phtml';
    }


}