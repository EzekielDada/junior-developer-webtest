<?php
require_once './core/Model.php';

abstract class Product extends Model
{
    const SKU = 'product_sku';
    const NAME = 'product_name';
    const PRICE = 'product_price';
    const TYPE = 'product_type';

    protected $sku;
    protected $name;
    protected $price;

    protected function validateProduct()
    {
        if (!isset($_POST[self::SKU], $_POST[self::NAME], $_POST[self::PRICE], $_POST[self::TYPE])) return false;

        $this->sku = ($_POST[self::SKU]);
        $this->name = ($_POST[self::NAME]);
        $this->price = ($_POST[self::PRICE]);
        $this->type = ($_POST[self::TYPE]);
        return true;
    }

    protected function insertProduct(array $product)
    {
        try {
            $db = $this->getDB();

            $data = ['`SKU`' => "'{$this->sku}'", '`Name`' => "'{$this->name}'", '`product_type`' => "'{$this->type}'", '`Price`' => "'{$this->price}'"];

            $data = array_merge($data, $product);

            $fields = implode(',', array_keys($data));
            $values = implode(',', array_values($data));

            $statement = "INSERT INTO `products`($fields) VALUES($values)";
            $sql = $db->query($statement);
            return $sql ? true : false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function deleteProduct()
    {
        try {
            $db = $this->getDB();
            if (!isset($_POST['delete-id'])) return false;

            $ids = implode(',', $_POST['delete-id']);
            $result = $db->query("DELETE FROM `products` WHERE `id` IN ($ids)");
            return $result ? true : false;
        } catch (\Throwable $th) {
            $th = $th->getMessage();
            echo $th;
            return false;
        }
    }
}
