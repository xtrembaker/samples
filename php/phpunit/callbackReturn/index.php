<?php

use PHPUnit\Framework\TestCase;

class Bot{

    public function handleResponse(BotSituation $botSituation, $key){
        $response = $botSituation->shiftStack($key);
        if($response === 'tata'){
            return 'GG !!';
        }
    }
}


class BotSituation{

    public $coachState;

    /**
     * BotSituation constructor.
     * @param CoachState $coachState
     */
    public function __construct(CoachState $coachState)
    {
        $this->coachState = $coachState;
    }

    /**
     * @param string $key
     */
    public function shiftStack(string $key){
        $stack = $this->coachState->getStack($key);
        if(array_key_exists($key, $stack)){
            return array_shift($stack[$key]);
        }
        return null;
    }

}

class CoachState{

    public $stack = [
        'nodeKey1' => [
            'toto',
            'titi',
            'tata'
        ],
        'nodeKey2' => [
            'vovo',
            'vivi',
            'vava'
        ]
    ];

    public function getStack(){
        return $this->stack;
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

    public function totoProvider(){
        return [
            [
                'nodeKey1' => 'nodeKey2',
                'nodeKey1' => [
                    'toto',
                    'titi',
                    'tata'
                ],
                'nodeKey2' => [
                    'vovo',
                    'vivi',
                    'vava'
                ]
            ],

        ];
    }

    /**
     * @dataProvider totoProvider
     */
    public function testHandleResponse($map, $stack){
        $coachStateMock = $this->getMockBuilder(CoachState::class)
            ->disableOriginalConstructor()
            ->getMock();
        $botSituationMock = $this->getMockBuilder(CoachState::class)
            ->disableOriginalConstructor()
            ->getMock();

        $coachStateMock->expect($this->any)->methode('getStack')
            ->will($this->returnValueMap($map));

        $botSituationMock->expect($this->any())->method('stack')
            ->with()

        $bot = new Bot();
        $bot->handleResponse($botSituationMock, 'nodeKey');

        //$tataMock = $this->getMockBuilder(Tata::class)->getMock();
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