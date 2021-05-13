<?php


namespace app\transport;


class Radio
{
    private string $work ;
    private string $type = "FM";//Default FM
    private int $volume;//default 0
    private static int $maxVolume = 100;


    public function __construct($volume = 10)
    {
        $this->work = "On";
        $this->volume = $volume;
    }

    public function setVolume(int $volume): void
    {
        if ($this->checkMaxVolume($volume)){
            $this->volume = $volume;
        }
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }


    public static function getMaxVolume(): int
    {
        return self::$maxVolume;
    }


    public function getWork(): string
    {
        return $this->work;
    }


    public function getVolume()
    {
        return $this->volume;
    }

    public function addVolume($volume): void
    {
        $newVolume = $this->volume + $volume;

        if ($this->checkMaxVolume($newVolume)){
            $this->volume = $newVolume;
        }
    }

    public function turnOff(): void
    {
        $this->volume = 0;
        $this->work = "Off";
    }

    private function checkMaxVolume($volume): bool
    {
        if ($volume < self::$maxVolume){
            return true;
        }
        return false;
    }

}