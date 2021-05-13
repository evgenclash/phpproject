<?php


namespace app\transport;


class Conditioner
{
    private string $work = "Off";
    private ?int $temperature;

    public function setConditioner(int $temp = 22)
    {

        if ($this->work === "Off"){
            $this->work = "On";
        }
        $this->temperature = $temp;
    }

    public function turnCondtionerOff()
    {
        $this->work = "Off";
        $this->temperature = null;
    }

    public function getTemp(): ?int
    {
        return $this->temperature;
    }

    public function getWork(): string
    {
        return $this->work;
    }
}