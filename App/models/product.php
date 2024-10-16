<?php

namespace App\models;

use Core\App;
use Core\Database;
use Core\Validator;

abstract class Product
{
    public string $sku;
    public string $name;
    public float $price;
    public string $type;
    public string $value;
    public array $data;


    public function __construct($input)
    {
        $this->data = $input;
    }

    public function validateProduct()
    {
        $errors = [];
        if ($this->validateSKU()) {
            $errors[] = $this->validateSKU();
        }
        if ($this->validateName()) {
            $errors[] = $this->validateName();
        }
        if ($this->validatePrice()) {
            $errors[] = $this->validatePrice();
        }
        if ($this->validateProductType()) {
            $errors[] = $this->validateProductType();
        }
        if ($this->validateValue()) {
            $errors[] = $this->validateValue();
        }

        return $errors;
    }

    private function validateSKU()
    {
        if (!$this->data['sku'] || ! Validator::string($this->data['name'],1)) {
            return "Product SKU is required!";
        } else {
            $this->sku = $this->data['sku'];
        }

        $database = App::resolve(Database::class);
        if ($database->getSKU($this->data['sku'])) {
            return "SKU already exists";
        }
    }

    private function validateName()
    {
        if (!$this->data['name'] || ! Validator::string($this->data['name'],1)) {
            return "Product name is required!";
        } else if (is_numeric($this->data['name'])) {
            return "Please, provide the data of indicated type";
        } else {
            $this->name = $this->data['name'];
        }
    }

    private function validatePrice()
    {
        if (!$this->data['price']) {
            return "Product price is required!";
        } else if ($this->data['price'] < 0) {
            return "Please provide correct price";
        } else {
           $this->price = floatval($this->data['price']);
        }
    }

    private function validateProductType()
    {
        if (!$this->data['type']) {
            return "Please provide product details!";
        }
        $this->type = $this->data['type'];
    }

    abstract protected function validateValue();
}
