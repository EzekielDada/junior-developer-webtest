<?php
require_once "./Models/Book.php";
require_once "./Models/Furniture.php";
require_once "./Models/Disc.php";

class DeleteController
{


    public function deleteProduct()
    {
        $Book = new Book;
        if ($Book->deleteProduct()) die('success');
        else die('error');
    }
}
$route = new DeleteController();
$route->deleteProduct();
