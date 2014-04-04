<?php namespace Acme\App\Rule;

use Acme\App\Contracts\AbstractValidator;
use Acme\App\Contracts\SpecialValidatorInterface;
use Acme\App\Exceptions\FileNotFoundException;
use Acme\App\Exceptions\FileValidatorMethodNotFoundException;
use SplFileInfo;


class FileValidator extends AbstractValidator implements SpecialValidatorInterface
{
	
	
	protected $message;
	
	protected $file;
	
	
	public function isValid()
	{
		$this->fill();		
		
		$this->startValidate();	
		
	}
	
	
	private function startValidate()
	{
		$this->file=new SplFileInfo($this->value);		
		
		$this->isFile();
		
		$this->callMethod();
		
		
	}
	
	protected function Validateext()
	{
		$argument=explode(",",$this->argument);	
		
		if(!in_array($this->file->getExtension(),$argument))
		{
			$this->setMessage($this->subject,"{$this->subject} does not have valid extension");
		}
		
	   
     }
	
	protected function Validatefilesize()
	{
		
		if($this->file->getSize()>$this->argument)
		{
			$this->setMessage($this->subject,"{$this->subject} file size is higher than {$this->argument}");
		}
	}
	
	function throwException()
	{
		throw new FileValidatorMethodNotFoundException();
	}
	
	
         private function isFile()
         {
		if(!$this->file->isFile())
			throw new FileNotFoundException();
		return true;
		
	  
        }
}
