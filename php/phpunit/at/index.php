<?php

use PHPUnit\Framework\TestCase; 

class Toto{

	public function vovo(Tata $tata){
		$result = [];
		$result[] = $tata->vava("foo");
		$result[] = $tata->vava("bar");
		$result[] = $tata->vava("foobar");
		return $result;
	}

}

class Tata{

	/**
	 *
	 */
	public function vava($foo){
		return $foo."bar";
	}
}

/**
 * To run test : 
 * Make sure you have phpunit install (composer install at the root)
 * 
 * Then : ../vendor/phpunit/phpunit/phpunit index.php 
 *
 *
 */
class TotoTest extends TestCase{


	public function testToto(){
		$tataMock = $this->getMockBuilder(Tata::class)->getMock();
		$toto = new Toto();
		$expected = [
			"foobar", "barbar", "foobarbar"
		];
		$tataMock->expects($this->at(0))->method('vava')->with("foo")->willReturn("foobar");
		$tataMock->expects($this->at(1))->method('vava')->with("bar")->willReturn("barbar");
		$tataMock->expects($this->at(2))->method('vava')->with("foobar")->willReturn("foobarbar");
		$result = $toto->vovo($tataMock);
		$this->assertEquals($expected, $result);
	}

}