<?php
namespace App\models\productTypes;
use App\models\Product;

class Furniture extends Product {
    protected function validateValue()
    {
        if(!is_numeric($this->getInputs()['height']) && !is_numeric($this->getInputs()['width']) && !is_numeric($this->getInputs()['length']) && !floatval($this->getInputs()['height'] >= 0) && !floatval($this->getInputs()['width'] >= 0) && !floatval($this->getInputs()['length'] >= 0))
        {
            return "Please provide proper input values";
        }
        if (!$this->getInputs()['height'] || !$this->getInputs()['width'] || !$this->getInputs()['length']) {
            return "One or More Dimensions Not Provided!";
        }
        return "";
    }
}