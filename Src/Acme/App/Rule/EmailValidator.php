<?php namespace Acme\App\Rule;

use Acme\App\Contracts\AbstractValidator;



class EmailValidator extends AbstractValidator
{
	protected $message=" is not a vaild email address";
	
	public function isValid()
	{	
		
		$email=$this->validator->getLastField("value");		
		
		
		if (!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$this->setMessage("email",$email.$this->message);					
			
			
	    }
		
	}
}
