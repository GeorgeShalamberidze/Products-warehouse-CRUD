<?php
namespace App\errors;
use ErrorException;

class HandleError {
    public static function errorHandle ($exeption) {
        http_response_code(500);

        echo json_encode([
            "code" => $exeption->getCode(),
            "message" => $exeption->getMessage(),
            "file" => $exeption->getFile(),
            "line" => $exeption->getLine(),
        ]);
    }

    public static function errorExeptionHandle (
        int $errno,
        string $errstr,
        string $errfile,
        int $errline
    ) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
}