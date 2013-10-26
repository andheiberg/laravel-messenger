<?php

class MyFirstTest extends PHPUnit_Framework_TestCase {

	public function testMe(){
		$this->assertFalse(false);
	}

    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }

}