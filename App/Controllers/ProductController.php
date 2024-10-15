<?php

namespace App\controllers;

use App\models\productTypes\InvalidProduct;
use Core\App;
use Core\Database;

class ProductController
{
    public static function index()
    {
        $db = App::resolve(Database::class);

        view('products/index.view.php', [
            'products' => $db->getProducts()
        ]);

    }

    public static function create()
    {
        view('products/create.view.php', [
            'errors' => [],
        ]);
    }

    public static function store()
    {
        $product = new InvalidProduct([]);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData = [];
            foreach ($_POST as $key => $value) {
                $productData[$key] = $value;
            }

            $providedProduct = "App\\models\\productTypes\\" . $_POST['type'];

            if (class_exists($providedProduct)) {
                $product = new $providedProduct($productData);
            } else {
                $product = new InvalidProduct($productData);
            }

            $errors = $product->validateProduct();

            if (!$errors) {
                $db = App::resolve(Database::class);
                $db->createProduct($product);
                redirect('/');
            }
        }

        view('products/create.view.php', [
            'errors' => $errors,
        ]);
    }

    public static function delete()
    {
        if (isset($_POST['checkedProducts'])) {
            $checkedProducts = $_POST['checkedProducts'];

            foreach ($checkedProducts as $productId) {
                $db = App::resolve(Database::class);
                $db->delete();
            }
        }
        redirect('/');
    }
}
