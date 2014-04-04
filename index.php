<?php


require "vendor/autoload.php";


use Acme\App\Validator;
$valid=new Validator;
echo "<pre>";

$valid->make(array("file"=>"baris.txt"),
              array("file"=>"filesize:3000"))
->run();
//$errors=$valid->errors();

