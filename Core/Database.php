<?php

namespace Core;

use PDO;
use App\models\Product;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config)
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $config['username'], $config['password'], [

            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

        ]);
    }

    public function getProducts()
    {
        $statement = $this->connection->prepare('SELECT * FROM products');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSKU($sku)
    {
        $statement = $this->connection->prepare('SELECT * FROM products WHERE sku = :sku');
        $statement->bindValue(':sku', $sku);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public function createProduct(Product $product)
    {
        $statement = $this->connection->prepare("INSERT INTO products (sku, name, price, type, value)
                VALUES (:sku, :name, :price, :type, :value)");

        $statement->bindValue(':sku', $product->sku);
        $statement->bindValue(':name', $product->name);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':type', $product->type);
        $statement->bindValue(':value', $product->value);

        $statement->execute();
    }

    public function delete()
    {
        for ($i = 0; $i < count($_POST['checkedProducts']); $i++) {
            $delProduct = $_POST['checkedProducts'][$i];
            $statement = $this->connection->prepare("DELETE FROM products WHERE id = '$delProduct'");
            $statement->execute();
        }
    }
}
