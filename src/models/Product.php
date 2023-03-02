<?php
namespace App\models;

use App\interfaces\ValidateInputs;
use App\Query;

abstract class Product implements  ValidateInputs {
    private string $sku;
    private string $name;
    private float $price;
    private string $type;
    private string $value;
    private array $inputs;
    private array $errorMsg = [];

    public function __construct($inputValues) {
        $this->inputs = $inputValues;
    }

    public function getSku(): string { return $this->sku; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getType(): string { return $this->type; }
    public function getValue(): string { return $this->value; }
    public function getInputs(): array { return $this->inputs; }

    abstract protected function validateValue();

    public function validateSku() {
        $qry = new Query();
        $checkProductInDB = $qry->fetchSingleProduct("*", $this->inputs["sku"]);

        if ($checkProductInDB) {
            return "SKU Already Exists!";
        }
        if (!$this->inputs['sku']) {
            return "SKU Not Provided!";
        }
        $this->sku = $this->inputs['sku'];
        return "";
    }

    public function validateName() {
        if ($this->inputs['name'] === "" || !$this->inputs['name']) {
            return "Name Not Provided";
        }
        $this->name = $this->inputs['name'];
        return "";
    }

    public function validatePrice() {
        if(!$this->inputs['price']) {
            return "Price was not provided!";
        }
        if (!filter_var($this->inputs['price'], FILTER_VALIDATE_FLOAT) || !(strlen($this->inputs['price']) > 0) || !(floatval($this->inputs['price']) >= 0)) {
            return "Price is Invalid";
        }
        $this->price = floatval($this->inputs['price']);
        return "";
    }

    public function validateType() {
        $validProductTypes = ["Book", "Furniture", "DVD"];
        if (!in_array($this->inputs['productType'], $validProductTypes)) {
            return "Valid Type Not Selected!";
        }
        $this->type = $this->inputs["productType"];
        return "";
    }

    public function validateInputs() {
        if ($this->validateSku()) {
            $this->errorMsg[] = $this->validateSku();
        }
        if ($this->validateName()) {
            $this->errorMsg[] = $this->validateName();
        }
        if ($this->validatePrice()) {
            $this->errorMsg[] = $this->validatePrice();
        }
        if ($this->validateType()) {
            $this->errorMsg[] = $this->validateType();
        }
        if ($this->validateValue()) {
            $this->errorMsg[] = $this->validateValue();
        }
        return $this->errorMsg;
    }
}