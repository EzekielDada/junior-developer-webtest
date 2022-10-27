<?php
require_once './Models/Product.php';
class Disc extends Product
{
    const SIZE = 'product_size';

    public function create()
    {
        if (!isset($_POST[self::SIZE])) return null;

        if (!$this->validateProduct()) return false;

        $product = ['`Size`' => ($_POST[self::SIZE])];
        return $this->insertProduct($product);
    }
}
