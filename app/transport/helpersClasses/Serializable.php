<?php


namespace app\transport;


interface Serializable
{
    public function __toString(): string;

    public function toArray(): array;
}