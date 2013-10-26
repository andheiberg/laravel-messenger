<?php

use \Pichkrement\Messenger\Lib\Helper as H;
use \Pichkrement\Messenger\Models\User as User;
use \Pichkrement\Messenger\Models\Message as Message;
use \Pichkrement\Messenger\Models\Conversation as Conversation;

class MyFirstTest extends TestCase {


	public function setUp(){

		parent::setUp();

		H::removeAll(User::all());

    	H::removeAll(Conversation::all());
	}

	public function testSendMail(){
		$sender = H::createRandomUser();
    	$rec = H::createRandomUser();

    	$sender->send($rec, "testnachricht");
	}

	public function testMe(){
		$this->assertFalse(false);
	}

    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }

}