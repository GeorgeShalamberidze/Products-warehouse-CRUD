<?php
require_once("./src/Validate.php");

class Furniture implements Validate {
    protected $inputs;

    function __construct(array $inputs) {
        $this->inputs = $inputs;
    }

    public function validateValues()
    {
        if(is_numeric($this->inputs['height']) && is_numeric($this->inputs['width']) && is_numeric($this->inputs['length']) && floatval($this->inputs['height'] >= 0) && floatval($this->inputs['width'] >= 0) && floatval($this->inputs['length'] >= 0))
        {
            return true;
        }
        echo json_encode([
            "message" => "Please provide proper input values",
        ]);
        return false;
    }
}