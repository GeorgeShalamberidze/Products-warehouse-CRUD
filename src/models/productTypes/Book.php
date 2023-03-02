<?php
namespace App\models\productTypes;
use App\models\Product;


class Book extends Product {
    protected function validateValue() {
        if(!is_numeric($this->getInputs()['weight']) && !floatval($this->getInputs()['weight'] >= 0))
        {
            return "Please provide proper input values";
        }
        if (!$this->getInputs()["weight"]) {
            return "Weight not provided!";
        }
        return "";
    }
}