<?php
require_once './Models/Product.php';

class Furniture extends Product
{
    const LENGTH = 'product_length';
    const WIDTH = 'product_width';
    const HEIGHT = 'product_height';

    public function create()
    {
        if (!isset($_POST[self::LENGTH], $_POST[self::WIDTH], $_POST[self::HEIGHT])) return null;
        
        if (!$this->validateProduct()) return false;

        $product = ['`Length`' => ($_POST[self::LENGTH]), '`Width`' => ($_POST[self::WIDTH]), '`Height`' => ($_POST[self::HEIGHT])];
        return $this->insertProduct($product);
    }
}
