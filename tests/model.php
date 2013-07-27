<?php

class Model extends DBTestCase {

	function setUp(){

		parent::setUp();

		$c = new Conversation;

		$this->user = new User(
			array(
				"username"=>"maxmustermann",
				"firstname"=>"max",
				"surname"=>"mustermann",
				"email"=>"max.mustermann@gmail.com"
				));

	}

	public function testUserModelUsername(){
		$this->assertEquals("maxmustermann", $this->user->username);
	}

	public function testUserModelFirstname(){
		$this->assertEquals("max", $this->user->firstname);
	}

	public function testUserModelSurname(){
		$this->assertEquals("mustermann", $this->user->surname);
	}

	public function testUserModelEmail(){
		$this->assertEquals("max.mustermann@gmail.com", $this->user->email);
	}

	public function testConversationModel(){
		$c = new Conversation;

		//$this->assertObjectHasAttribute("id", $c);
	}
}