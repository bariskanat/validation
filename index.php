<?php


require "vendor/autoload.php";


use Acme\App\Validator;
$valid=new Validator;
echo "<pre>";

$valid->validate(array("email"=>"bkanat@gmail.com"),array("email"=>"email|required|min:3"));
