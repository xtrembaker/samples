<?php

class Tata{


	public function __construct(){
		echo "construct\n";
	}

	public function __invoke(){
		echo "invoke\n";
	}

}

$tataInstance = new Tata;
$tataInstance();
