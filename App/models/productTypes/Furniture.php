<?php

namespace App\models\productTypes;

use App\models\Product;

class Furniture extends Product
{
    protected function validateValue()
    {
        if (!$this->data['height'] || !$this->data['height'] || !$this->data['height']) {
            return "One or more of dimensions were not provided!";
        }

        if (
            is_numeric($this->data['height']) && $this->data['height'] >= 0 &&
            is_numeric($this->data['width']) && $this->data['width'] >= 0 &&
            is_numeric($this->data['length']) && $this->data['length'] >= 0
        ) {
            $this->value = 'Dimensions: ' . $this->data['height'] . 'x' . $this->data['width'] . 'x' . $this->data['length'] . ' CM';
            return "";
        }

        return "One or more invalid values for dimensions!";
    }
};
