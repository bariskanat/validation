<?php 

namespace Acme\App;

use Countable;
use IteratorAggregate;
use Acme\App\Contracts\MessageInterface;


class Message implements Countable,MessageInterface,IteratorAggregate
{
	
	
	private $message=array();
	
    public function all()
	{
		return $this->message;
	}
	
	
     public  function set($name,$value)
     {
		
		$this->message[$name][]=$value;
	 }
	 
	 
	 public function has($name)
	 {
	 	return (isset($this->message[$name]));
	 }
	 
	 public function get($name)
	 {
	    return ($this->has($name))?$this->message[$name]:null;
	 }
	 
	 public function emptyAll()
	 {
	 	$this->messsage=[];
	 }
	 
	 public function delete($name)
	 {
	 	if($this->has($name))
		  unset($this->message[$name]);
	 }
	 
	 
	 public function count()
	 {
	 	return count($this->message);
	 }
	 
	 public function getIterator()
	 {
        return new \ArrayIterator($this->message);
    }
	 
	 
	
	 
	 
	 
}
