<?php


class operators
{
//    properties
    public $name;
    public $operatorUri;
    public $cardUri;
    public $cardLogoUri;
//    methods
    public function __construct($name, $operatorUri, $cardUri, $cardLogoUri){
        $this->name = $name;
        $this->operatorUri = $operatorUri;
        $this->cardUri = $cardUri;
        $this->cardLogoUri = $cardLogoUri;
    }

}