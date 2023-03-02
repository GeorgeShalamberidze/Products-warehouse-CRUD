<?php
namespace App\interfaces;
interface ValidateInputs {
    public function validateSku();
    public function validateName();
    public function validatePrice();
    public function validateType();
}
?>