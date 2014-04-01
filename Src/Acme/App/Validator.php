<?php

namespace Acme\App;


class Validator{
	
	protected $error;
	
	protected $rules;
	
	protected $data;
	
	public function validate(array $data,array $rule)
	{
		//array("email" =>"required|min:8")
		$this->rules=$this->parseRules($rule);
		$this->data=$data;
		
		
		
		
		
		foreach($rule as $key =>$value)
		{
			$rules=explode("|",$value);
			
			foreach($rules as $k=>$v)
			{
				//array(requireed,min:8)
				
				$pos=strpos($v,":");
				
				if($pos!==false)
				{
					
					$arguments=substr($v,$pos+1);
					$method=substr($v,0,$pos);
				}
				else {
					$arguments="";
					$method=$v;
				}
				
				
				$methodName="validate".ucfirst($method);
				
				$data=(isset($data[$key]))?$data[$key]:null;
				
				if(method_exists($this, $methodName) && !is_null($data));
				{
					$this->{$methodName}($key,$data,$arguments);
				}
				
			}
			
		}
		
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
		$this->error[$name]=$error;
	}
	
	public function getAllError()
	{
		return $this->error;
	}
	
	public function validateEmail($item,$email,$arguments)
	{
		var_dump($email,$item,$arguments);
		die;
		
	   if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	   {
	   	  $this->error[$item]=$item. " is not valid";
	   	  return false;
	   }
	   
	   return true;
	}
	
	
	public function validateRequired($data)
	{
		
		
	}
	
	public function validateMin($data,$argument){}
	
	public function validateMax($data,$argument){}
}
