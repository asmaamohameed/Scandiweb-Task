<?php

namespace App\models\productTypes;

use App\models\Product;

class InvalidProduct extends Product
{
    protected function validateValue()
    {
        return "Please select type of product!"; 
    }
}