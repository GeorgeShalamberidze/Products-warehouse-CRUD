<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require "./src/Product.php";
require "./src/ProductController.php";
require "./src/HandleError.php";

if (
    isset( $_SERVER['REQUEST_METHOD'] )
    && $_SERVER['REQUEST_METHOD'] === 'OPTIONS'
  ) {
    header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
    header( 'Access-Control-Max-Age: 86400' );
    header( 'Cache-Control: public, max-age=86400' );
    header( 'Vary: origin' );
    exit( 0 );
  }

set_error_handler("HandleError::errorExeptionHandle");
set_exception_handler("HandleError::errorHandle");

$product = new Product();
$controller= new ProductController($product);
$controller->processRequest($_SERVER["REQUEST_METHOD"]);