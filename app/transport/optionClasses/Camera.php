<?php


namespace app\transport;


class Camera
{
    private string $mode = 'Off';
    protected string $camera;

    public function __construct($camera = 'None')
    {
        $this->camera = $camera;
    }

    public function setCamera(string $camera): void
    {
        $this->camera = $camera;
    }

    public function onMode(): void
    {
        $this->mode = "On " . $this->camera;
    }

    public function offMode(): void
    {
        $this->mode = "Off" . $this->camera;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function getCamera():string
    {
        return $this->camera;
    }

}