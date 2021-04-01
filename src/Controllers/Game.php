<?php

declare(strict_types=1);


namespace App\Controllers;
error_reporting(0);
header("Content-type: text/html; charset=utf-8");

use App\Repository\WordRepository;
use App\Resources\App;
use App\Resources\IO;

class Game extends App
{
    private IO $IO;
    private string $move;
    private int $bonusPosition;
    private \ArrayObject $matches;
    private \ArrayObject $nonUsedLetters;
    private int $record = 0;

    public function __construct(IO $inputOutput)
    {
        $this->IO = $inputOutput;
        $this->welcome();
        $this->init();
    }

    public function init()
    {
        $this->nonUsedLetters = new \ArrayObject();
        $moveInput = $this->getUserMove();
        $this->setBonusPosition();
        $this->addNonUsedLetter(HandleWord::collectGarbage($moveInput));
        $this->setMatches();
        $this->setNonUsedLetters();
        $this->showResult();
    }

    public function showResult(){
       $this->ranking(
           $this->getRankedResult(
               $this->matches));
        $this->init();
    }

    public function ranking($rankedMatches){
        $this->IO->print("Você encontrou {$rankedMatches->count()} palavras");
        $total = 0;
        $i = 1;
        foreach($rankedMatches as $match){
            $this->IO->print("{$i}º- ".ucfirst($match->getWord()) ." com {$match->getPunctuation()} pontos");
            $total += $match->getPunctuation();
            $i++;
        }
        $this->IO->print("Fazendo um total de {$total} pontos");
        $this->showNonUsed();
        $this->IO->print($this->isRecord($total));
    }

    public function isRecord($total):string
    {
        if($this->record < $total){
            $message = "PARABÉNS, VOCÊ BATEU SEU RECORD ANTERIOR DE {$this->record} PONTOS";
            $this->record = $total;
            return $message;
        }else{
            return "Não foi dessa vez que você bateu seu record, continue tentando, seu record atual é de {$this->record} pontos";
        }
    }

    public function showNonUsed(){
        if(sizeof($this->nonUsedLetters) > 0){
            $nonUsed =  implode(",", $this->nonUsedLetters->getArrayCopy());
            (sizeof($this->nonUsedLetters) > 1) ? $this->IO->print("Sobraram: {$nonUsed}") :  $this->IO->print("sobrou: {$nonUsed}");
        }else{
            $this->IO->print("NÃO SOBROU NENHUMA LETRA");
        }
    }

    public function welcome():void
    {
        $this->IO->print("Olá, bem vindo ao Monta Palavras do Letras.com.br ");
    }

    public function setBonusPosition()
    {
        $this->IO->print("Digite a posição Bonus");
        $bonusInput = $this->IO->read();
        $this->validadeBonusPositionInput($bonusInput);
        $this->bonusPosition = (int) $bonusInput;
    }

    public function getUserMove():string
    {
        $this->IO->print("#Digite as letras disponíveis nesta jogada: ");
        $moveInput = $this->IO->read();
        $this->validadeMoveInput($moveInput);
        $this->move = HandleWord::cleanInput($moveInput);
        return $moveInput;
    }

    private function validadeBonusPositionInput(string $input)
    {

        if(preg_match("/[\D]/i", $input)){
            $this->IO->print("Você deve digitar apenas números nesse campo, tente novamente");
            $this->setBonusPosition();
        }
    }

    private function validadeMoveInput(string $input):void
    {
        if(strlen($input) < 3){
            $this->IO->print("Você precisa digitar ao Menos 2 letras");
            $this->init();
        }
    }

    private function setNonUsedLetters():void
    {
        $this->addNonUsedLetter($this->findMatchNonUsedLetters(HandleWord::arrayObjectToString($this->matches), $this->move));
    }

    private function setMatches():void
    {
        $this->matches = $this->matchWords($this->move, WordRepository::load(), $this->bonusPosition);
    }

    private function addNonUsedLetter(string|null $letter):void
    {
        if(strlen($letter) && $letter != null){
            foreach(HandleWord::wordToArray($letter) as $char) {
                !empty($char) ? $this->nonUsedLetters->append(trim($char)):false;
            }
        }
    }

}