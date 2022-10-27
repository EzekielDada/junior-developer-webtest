<?php
require_once "./Models/Book.php";
require_once "./Models/Furniture.php";
require_once "./Models/Disc.php";

class CreateController
{

    public function createProduct()
    {
        $Disc = new Disc;
        $Furniture = new Furniture;
        $Book = new Book;

        $product = $Disc->create();
        $product = is_null($product) ? $Furniture->create() : $product;
        $product = is_null($product) ? $Book->create() : $product;

        if ($product) die('success');
        else die('error');
    }

}
$route = new CreateController();
$route->createProduct();
