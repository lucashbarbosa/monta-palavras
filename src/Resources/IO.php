<?php

declare(strict_types=1);
namespace App\Resources;


use App\Interfaces\IOStream;

class IO implements IOStream
{
    public function __construct()
    {
    }

    public function read(): string
    {

        return trim(readline());
    }



    public function print(string $message): void
    {
        echo $message . "\n";
    }
}