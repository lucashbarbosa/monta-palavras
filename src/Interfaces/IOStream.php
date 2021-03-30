<?php

namespace App\Interfaces;


interface IOStream
{
    public function read():string;
    public function print(String $message):void;
}