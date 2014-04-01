<?php


require "../vendor/autoload.php";
use Acme\App\User;

class UserTest extends \PHPUnit_Framework_TestCase{
	
	
	protected $user;
	
	public function setUp()
	{
		$this->user=new User;
	}
	
	
	public function testgetEmail(){
		
		$this->user->setEmail("bkanat@gmail.com");
		$this->assertEquals("bkanat@gmail.com",$this->user->getEmail());
	}
	
	
	public function testPassword()
	{
		$this->user->setPassword(12345678);
		$this->assertEquals("ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f",$this->user->getPassword());
	}
	
	
	 /**
     * @expectedException Exception
     */
     
     public function testPasswordRetrunException()
     {
     	
		$this->user->setPassword("17");
     }
	 
	 /**
     * @expectedException Exception
     */
     
     public function testEmailRetrunException()
     {
     	
		$this->user->setEmail("bb");
     }
	 
	 
	 public function testemailSetting()
	 {
	 	$email=$this->user->setEmail("bkanat@gmail.com");
	 	$this->assertEquals("bkanat@gmail.com",$this->user->getEmail());
	 }
	 
	 public function tearDown(){
	 	Mockery::close();
	 }
}
