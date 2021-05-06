<?php

namespace App;

class Operator
{
//    properties
    private string $name;
    private string $operatorUri;
    private string $cardUri;
    private string $cardLogoUri;

//    methods
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setOperatorUri($operatorUri)
    {
        $this->operatorUri = $operatorUri;
    }

    public function setCardUri($cardUri)
    {
        $this->cardUri = $cardUri;
    }

    public function setLogoUri($logoUri)
    {
        $this->cardLogoUri = $logoUri;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getOperatorUri():string
    {
        return $this->operatorUri;
    }

    public function getCardUri():string
    {
        return $this->cardUri;
    }

    public function getCardLogoUri():string
    {
        return $this->cardLogoUri;
    }
}