<?php

class Model extends TestCase {
	public function testUserModelUsername(){
		$user = new User;

		$this->assertObjectHasAttribute("username", $user);
	}

	public function testUserModelFirstname(){
		$user = new User;

		$this->assertObjectHasAttribute("firstname", $user);
	}

	public function testUserModelSurname(){
		$user = new User;

		$this->assertObjectHasAttribute("surname", $user);
	}

	public function testUserModelEmail(){
		$user = new User;
		
		$this->assertObjectHasAttribute("email", $user);
	}
}