<?php

require 'vendor/autoload.php';


use App\Controllers\Game;
use App\Resources\IO;

new Game(new IO());