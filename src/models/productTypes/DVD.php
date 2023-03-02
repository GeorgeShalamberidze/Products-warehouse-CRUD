<?php
namespace App\models\productTypes;
use App\models\Product;

class DVD extends Product {
    protected function validateValue()
    {
        if(!is_numeric($this->getInputs()['size']) && !floatval($this->getInputs()['size'] >= 0))
        {
            return "Please provide proper input values";
        }
        if (!$this->getInputs()['size']) {
            return "Size not Provided!";
        }
        return "";
    }
}