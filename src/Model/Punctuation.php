<?php


namespace App\Model;


use App\Controllers\HandleWord;
use App\Repository\WordRepository;

class Punctuation
{


    public function definePunctuation(string $word, int $bonusPosition):int
    {
        $lettersPunctuation = WordRepository::getLetterPunctuation();
        $punctuation = 0;
        $wordArray = HandleWord::wordToArray($word);
        $i = 0;
        foreach ($wordArray as $letter) {
                if($i == $bonusPosition && $bonusPosition > 0){
                    $punctuation += $lettersPunctuation[$letter] * 2;
                }else{
                    $punctuation += $lettersPunctuation[$letter];
                }
            $i++;
        }
        return $punctuation;

    }


}