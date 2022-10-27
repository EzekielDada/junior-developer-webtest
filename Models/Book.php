<?php

require_once './Models/Product.php';


class Book extends Product
{
    const WEIGHT = 'product_weight';

    public function create()
    {
        if (!isset($_POST[self::WEIGHT])) return null;

        if (!$this->validateProduct()) return false;

        $product = ['`Weight`' => ($_POST[self::WEIGHT])];
        return $this->insertProduct($product);
    }
}
