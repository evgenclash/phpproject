<?php


class Operators
{
//    properties
    public string $name;
    public string $operatorUri;
    public string $cardUri;
    public string $cardLogoUri;
//    methods
    public function __construct($name){
        $this->name = $name;
    }

    public function set_operator_uri($operatorUri){
        $this->operatorUri = $operatorUri;
    }

    public function set_card_uri($cardUri){
        $this->cardUri = $cardUri;
    }

    public function set_logo_uri($logoUri){
        $this->cardLogoUri = $logoUri;
    }

    public function __get($name){

        return $this->name;
}

}