<?php
declare(encoding='UTF-8');

namespace App\Controllers;


use App\Resources\App;
use App\Resources\IO;

class Game extends App
{
    private IO $IO;
    private string $roundInput;

    public function __construct(IO $inputOutput)
    {
        $this->IO = $inputOutput;
        $this->init();
    }

    public function init()
    {
        $this->welcome();
        $this->getFirstInput();
        $matches = $this->matchWords($this->roundInput);
        var_dump($matches);
        echo $this->nonUsedLetters(HandleWord::arrayToString($matches), $this->roundInput);

    }


    public function welcome()
    {
        $this->IO->print("Olá, bem vindo ao Monta Palavras do Letras.com.br ");

    }
    public function getFirstInput(){
        $this->IO->print("#Digite as letras disponíveis nesta jogada: ");
        $this->roundInput = $this->IO->read();
    }



//
//foreach($this->getCleanWords() as $palavra){
//$pattern = "/\b([".$input."]+)\b/i";
//$clean =  $this->retiraAcentos($palavra);
////            echo '"'.$clean . '"'  . " , ";
//echo preg_match($pattern, $clean) ? $clean . "\n" : "";
//
//}

//$letras = $this->read();








}