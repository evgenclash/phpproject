<?php


namespace App;


class Armor
{
    private string $name;
    private string $type;
    private string $category;
    private string $photoUri;

    public function __construct($name = 'undefined', $type = 'undefined', $category = 'undefinde', $photoUri = 'undefined')
    {
        $this->name = $name;
        $this->type = $type;
        $this->photoUri = $photoUri;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setPhotoUri(string $photoUri): void
    {
        $this->photoUri = $photoUri;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPhotoUri(): string
    {
        return $this->photoUri;
    }

}