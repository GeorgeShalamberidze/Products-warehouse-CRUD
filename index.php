<?php
require_once realpath("vendor/autoload.php");
use App\controller\ProductController;

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

$methodOption = $_SERVER["REQUEST_METHOD"];
$controller= new ProductController();
$controller->processRequest($methodOption);