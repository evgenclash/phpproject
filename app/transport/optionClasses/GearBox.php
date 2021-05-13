<?php


namespace app\transport;


class GearBox
{
    private string $mode = "Neutral";
    private $camera;
    public function __construct($camera)
    {
        $this->camera = $camera;
    }

    public function drive()
    {
        $this->mode = "Drive";
        $this->camera->offMode();
    }

    public function reverse()
    {
        $this->mode = "Reverse";
        $this->camera->onMode();
    }


}