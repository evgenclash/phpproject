<?php

namespace App;

class Operator
{
//    properties
    private string $name;
    private string $operatorUri;
    private string $cardUri;
    private string $cardLogoUri;
    private string $side;
    private array $stats;
    private ArmorCollection $armorCollection;

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

    public function setSide(string $side): void
    {
        $this->side = $side;
    }

    public function setStats(array $stats): void
    {
        $this->stats = $stats;
    }

    public function getStats(): array
    {
        return $this->stats;
    }

    public function setArmorCollection(ArmorCollection $armorCollection): void
    {
        $this->armorCollection = $armorCollection;
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

    public function getSide(): string
    {
        return $this->side;
    }

    public function getArmorCollection(): ArmorCollection
    {
        return $this->armorCollection;
    }
}