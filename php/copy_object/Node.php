<?php

require "Connections.php";

class Node{

    protected $connections = [];

    public function __construct(){
        $this->connections = [
            new Connection('toto'),
            new Connection('tata'),
            new Connection('titi')
        ];
    }

    public function getConnections(){
        return $this->connections;
    }
}