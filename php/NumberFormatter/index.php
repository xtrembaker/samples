<?php

class Toto{


	public function doSomething(){
		$formatter = new NumberFormatter(
                'fr_FR',
                NumberFormatter::CURRENCY
            );
		return $formatter->formatCurrency('780,80', 'EUR');
	}

}

$toto = new Toto();
$toto->doSomething();