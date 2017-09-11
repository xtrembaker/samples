<?php

class Toto{
    

    public function __invoke(){
        $this->doSomething();
    }

    protected function doSomething(){
        $formatter = new NumberFormatter(
                'fr_FR',
                NumberFormatter::CURRENCY
            );
        return $formatter->formatCurrency('780,80', 'EUR');
    }
}



class Titi{

    protected $toto;
    
    public function __construct(Toto $toto){
        $this->toto = $toto;
    }

    public function doOtherThing(){
        $toto = $this->toto;
        try{
            return call_user_func($this->toto);
            //return $toto();
        }catch(Exception $e){
            echo "Error : ".$e->getMessage();
        }

        
    }

}

$titi = new Titi(new Toto());
$titi->doOtherThing();