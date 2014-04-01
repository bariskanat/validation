<?php namespace Acme\App;

use Exception;
class User{
	
	
	private $email;
	
	private $user;
	
	protected $validator;
	
	const MNCHAR=7;
	
	public function __construct(Validator $validator)
	{
		
		$this->validator=$validator;
	}
	
	public function login()
	{
		return "user is logged in";
		
	}
	
	
	public function logout(){
		
		return "user logged out";
	}
	
	
	
	public function setPassword($string)
    {
		
		if(!$this->validatePassword($string)){
			
			throw new Exception("the password must be at least ".self::MNCHAR);
		}
		
		$this->password=hash("sha256",$string);
		return $this;
		
	}
	
	
	public function getPassword(){
		return $this->password;
	}
	public function setEmail($email)
	{
		if(!$this->validateEmail($email))
		{
			
			throw new Exception("it is not a valid email ");
		}
		
		$this->email=$email;
		
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	private function validatePassword($string)
	{
	
		return (strlen($string)>self::MNCHAR );
	}


   private function validateEmail($email)
   {
   		return filter_var($email,FILTER_VALIDATE_EMAIL);
		
   }
	
	
}



