<?php

require 'vendor/autoload.php';
header("Content-type: text/html; charset=utf-8");
use App\Controllers\Game;
use App\Resources\IO;

new Game(new IO());