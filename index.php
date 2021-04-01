<?php

require 'vendor/autoload.php';

error_reporting(0);
use App\Controllers\Game;
use App\Resources\IO;

new Game(new IO());