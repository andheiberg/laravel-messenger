<?php


class ModelTest extends PHPUnit_Framework_TestCase {
	

	public function setUp()  {
		$this->mock = Mockery::mock('Eloquent', 'Message');
	}


	public function tearDown(){
		Mockery::close();
	}


	public function testMe(){
		$this->mock
           ->shouldReceive('all')
           ->once()
           ->andReturn('foo');
 
		//$this->app->instance('Message', $this->mock);


		//var_dump($this->mock);
		$this->mock->all();
	}
}