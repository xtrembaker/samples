<?php

use PHPUnit\Framework\TestCase; 

class Toto{

	public function vovo(Tata $tata, Titi $titi){
		$titi1 = new Titi();
		$titi2 = new Titi();
		$collection = [
			$titi1->setName('titi1'),
			$titi2->setName('titi2')
		];
		return $tata->vava($collection);
	}

}

class Tata{

	/**
	 *
	 */
	public function vava(array $collection){
		$result = [];
		foreach ($collection as $titi) {
			$result[] = $titi->getName();
		}
		return $result;
	}
}

class Titi{

	protected $name;

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}
}

/**
 * To run test : 
 * Make sure you have phpunit install (composer install at the root)
 * 
 * Then : ../vendor/phpunit/phpunit/phpunit index.php 
 *
 */
class TotoTest extends TestCase{


	public function testToto(){
		$tataMock = $this->getMockBuilder(Tata::class)->getMock();
		$titi1 = new Titi(); //$titi->setName('titi1');
		$titi2 = new Titi();
		$collection = [
			$titi1->setName('titi1'),
			$titi2->setName('titi2')
		];
		$toto = new Toto();
		$expected = [
			"titi1", "titi2"
		];
		$tataMock->expects($this->at(0))->method('vava')->with($collection)->willReturn($expected);
		$result = $toto->vovo($tataMock, new Titi());
		$this->assertEquals($expected, $result);
	}

}