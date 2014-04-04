<?php

namespace Acme\App\Contracts;


interface MessageInterface
{	
	
	public function all();	
	
	public function set($name,$data);
	
	public function get($name);
}
