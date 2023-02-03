<?php
require_once("./src/Validate.php");

class DVD implements Validate {
    protected $inputs;

    function __construct(array $inputs) {
        $this->inputs = $inputs;
    }

    public function validateValues()
    {
        if(is_numeric($this->inputs['size']) && floatval($this->inputs['size'] >= 0))
        {
            return true;
        }
        echo json_encode([
            "message" => "Please provide proper input values",
        ]);
        return false;
    }
}