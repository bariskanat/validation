<?php

namespace Acme\App;
use Acme\App\Message;
use Acme\App\Exceptions\ValidatorNotFoundException;
use Acme\App\Contracts\ValidatorInterface;

class Validator implements ValidatorInterface
{
	
	protected $error;
	
	protected $rules;
	
	protected $data;
	
	protected $message;
	
	protected $messageField=array();
	
	protected $lastfield=array();
	
	private $path="\\Acme\\App\\Rule\\";
	
	protected $classNamespace=[
	   "numeric"=>["min","max","lessthan","greaterthan","equals","required","minlength","maxlength"],
	   "email" =>["email"],
	   "file" =>["isfile","ext","filesize"]
	];
	
	
	
	public function __construct(MessageInterface $message=null)
	{
		$this->message=(!is_null($message))?$message:new Message;
	}
	
	public function make(array $data=array(),array $rule=array(),$messageField=array())
	{
		$this->rules=$this->parseRules($rule);
				
		$this->data=$data;
			
		$this->messageField=$messageField;	
		
		return $this;
	}
	

	
	public function getArgument($rule)
	{
		$pos=strpos($rule,":");
		
		
		return ($pos!==false)?array(substr($rule,0,$pos),substr($rule,$pos+1)):array($rule,"");
		
	}
	
	
	public function passes()
	{
	
	 
		
		foreach($this->data as $attr => $value)
		{
		    
			
			if(isset($this->rules[$attr]))
			{
				
				$this->callIterateRule($attr,$this->rules[$attr]);
			}
					
		}
	
		return ($this->countErrors())? true:false;
	}
	
	
	private function callIterateRule($subject,$rules)
	{
		foreach($rules as $rule)
		{
			$this->setLastFields($subject,$rule);			
			
			$this->startValidate();
		}
	}
	
	public function getValidatorClass($rule)
	{
		$class=$this->getClassName($rule);
	
		return (class_exists($class))?$class:false;
	}
	
	
	private function getClassName($class)
	{
		$class=$this->findClass($class);
		return $this->path.ucfirst($class)."Validator";
	}
	
	private function findClass($class)
	{
		foreach($this->classNamespace as $name => $classNameField)
		{
			if(in_array($class,$classNameField))
			 return $name;
		}
		
		throw new ValidatorNotFoundException();
		
	}
	
	private function setLastFields($subject,$rule)
	{
		list($rule,$argument)=$this->getArgument($rule);
		$value=$this->getData($subject);
		$this->lastfield=compact("rule","argument","subject","value");
		
	}
	
	public function getLastField($type=null)
	{
		if(!is_null($type))
		{
			return (isset($this->lastfield[$type]))?$this->lastfield[$type]:null;
		}
		return  $this->lastfield;
	}
	
	private function startValidate()
	{
		
		   if(!($result=$this->getValidatorClass($this->lastfield['rule'])))
		   {
		   	  throw new ValidatorNotFoundException();
		   }			
		    
	       $this->callValidator($result);			 
    }
	
	private function callValidator($result)
	{
		$class=new $result($this);		
		
		$class->isValid();	
		
	}
	
	public function run()
	{
		return (!$this->passes())?false:true;
	}
	
	
	private function parseRules($rule)
	{
		
		
		foreach($rule as $key=>&$value)
		{
			$value=(is_string($value)) ? explode("|", $value):$value;
		}
		
		
		
		return $rule;
	}
	
	
	
	public function setError($name,$error)
	{
		$this->message->set($name,$error);
	}
	
	
	public function countErrors()
	{
		 return count($this->message);
	}
	
	public function errors()
	{
		return ($this->countErrors())?$this->message:null;
	}
	
	public function getData($item)
	{
		return (isset($this->data[$item])) ? $this->data[$item]:null;
	}
 
}
