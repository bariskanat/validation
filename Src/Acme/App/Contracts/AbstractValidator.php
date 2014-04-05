<?php namespace Acme\App\Contracts;
use Acme\App\Contracts\ValidatorInterface;
use Acme\App\Validator;
use Acme\App\Exceptions\FileValidatorMethodNotFoundException;


  abstract class AbstractValidator
  {
  	
	protected $message;
	
	protected $rule;
	
	protected $argument;
	
	protected $subject;
	
	protected $value;	
	
	protected $validator;
	
	
	protected function fill()
	{
		$fields=$this->validator->getLastField();
		
		foreach($fields as $key=>$value)
		{
			
			   if(property_exists($this, $key))
			   {
			  	$this->{$key}=$value;
			   }
				 
		
		}
	}
		
	
	public function callMethod()
	{
		$methodName="Validate".strtolower($this->rule);	
		
		
		if(!method_exists($this,$methodName))
		{
			$this->throwException();
			
		}
		
		 $this->{$methodName}();
	}
	
	
	
	
	public function __construct(ValidatorInterface $validator =null)
	{
		$this->validator =(is_null($validator))? new Validator : $validator;
        }
	
	
	abstract public function isValid();
	
	
	protected function setMessage($type,$message)
	{
		$this->message=$message;
		
		$this->validator->setError($type,$this->message);
	}
	
	protected function  getMessage()
	{
		return $this->message;
	}
	
  }
