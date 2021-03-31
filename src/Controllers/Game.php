<?php



namespace App\Controllers;
header("Content-type: text/html; charset=utf-8");
use App\Model\Word;
use App\Repository\WordRepository;
use App\Resources\App;
use App\Resources\IO;

class Game extends App
{
    private IO $IO;
    private string $roundInput;
    private \ArrayObject $matches;
    private array|null $nonUsedLetters;
    private int $record = 0;

    public function __construct(IO $inputOutput)
    {
        $this->IO = $inputOutput;
        $this->welcome();
        $this->init();
    }

    public function init()
    {
        $this->getFirstInput();
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
        foreach($rankedMatches as $match){
            $this->IO->print(ucfirst($match->getWord()) ." com {$match->getPunctuation()} pontos");
            $total += $match->getPunctuation();
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
            $nonUsed = "";
            foreach($this->nonUsedLetters as $letter){
                $nonUsed .= $letter .",";
            }
            (sizeof($this->nonUsedLetters) > 1) ? $this->IO->print("Sobraram: {$nonUsed}") :  $this->IO->print("sobrou: {$nonUsed}");
        }else{
            $this->IO->print("NÃO SOBROU NENHUMA LETRA");
        }


    }

    public function welcome()
    {
        $this->IO->print("Olá, bem vindo ao Monta Palavras do Letras.com.br ");

    }
    public function getFirstInput()
    {
        $this->IO->print("#Digite as letras disponíveis nesta jogada: ");
        $this->roundInput = $this->IO->read();
    }

    private function setNonUsedLetters()
    {
        $this->nonUsedLetters  = HandleWord::wordToArray($this->nonUsedLetters(
            HandleWord::arrayObjectToString(
                $this->matches), $this->roundInput));

    }

    private function setMatches()
    {
        $this->matches = $this->matchWords($this->roundInput, WordRepository::load());
    }


}