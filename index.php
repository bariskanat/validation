<?php


require "vendor/autoload.php";


use Acme\App\Validator;
$valid=new Validator;
echo "<pre>";

$valid->make(array("file"=>"main.txt","firstname"=>"baris","email"=>"yooremail@gmail"),
              array("file"=>"filesize:3|ext:jpg","firstname"=>"required|min:5|max:20","email"=>"email"))
->run();
$errors=$valid->errors();


foreach($errors as $key){
	var_dump($key);
}

