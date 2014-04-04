<?php namespace Acme\App\Rule;

use Acme\App\Contracts\AbstractValidator;
use Acme\App\Contracts\SpecialValidatorInterface;

class NumericValidator extends AbstractValidator implements SpecialValidatorInterface
{
	
	protected $message = "";	
	
	private $messagemin=" field's length must be higher than ";
	
	private $messagemax =" field's length must be less than ";
	
	
    public function isValid()
	{
		
		$this->fill();		
		
		$methodName=$this->callMethod();	
	}
	
	
	public function throwException()
	{
		throw new NumericValidatorMethodNotFoundException();
	}
	
	
	
	protected function Validatemin()
	{
		if(strlen($this->value)<$this->argument)
		{
			$this->setMessage($this->subject,$this->subject.$this->messagemin.$this->value);				
			
		}
	}
	
	protected function Validatemax()
	{
		if(strlen($this->value)> $this->argument)
		{
			$this->setMessage($this->subject,$this->subject.$this->messagemax.$this->argument);			
			
		}
	}
	
	protected function Validatelessthan()
	{
		
		$this->typeCastToInterger();
		
	    if($this->value>$this->argument)
		{
			$this->setMessage($this->subject,$this->subject.$this->messagemax.$this->value);
		}
	    	
	}
	
	
	private  function typeCastToInterger()
	{
		$this->value=(int)$this->value;
		$this->argument=(int)$this->argument;
	}
	
	protected function Validategreaterthan()
	{
		
		$this->typeCastToInterger();
		
	    if($this->value>$this->argument)
		{
			$this->setMessage($this->subject,"value of {$this->subject} must be greater than {$this->argument}");
		}
	    			
			
		
	}	
	
	protected function Validaterequired()
	{
		
		if(!strlen(trim($this->value)))
		{
			$this->setMessage($this->subject,$this->subject." field must be required");
		}
	    	
	}
	
	protected function Validateminlength()
	{
		if(strlen(trim($this->value))<$this->argument)
		{
			$this->setMessage($this->subject,$this->subject." field's length mustt be higher than {$this->argument}");
		}
	}
	
	protected function Validatemaxlength()
    {
    	if(strlen(trim($this->value))>$this->argument)
		{
			$this->setMessage($this->subject,$this->subject." field's length mustt be less than {$this->argument}");
		}
	}
}
