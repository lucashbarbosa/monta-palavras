<?php


namespace App\Model;


use App\Controllers\HandleWord;
use App\Repository\WordRepository;

class Punctuation
{


    public function definePunctuation(string $word):int
    {
        $lettersPunctuation = WordRepository::getLetterPunctuation();
        $punctuation = 0;
        $wordArray = HandleWord::wordToArray($word);
        foreach ($wordArray as $letter) {
                $punctuation += $lettersPunctuation[$letter];
        }
        return $punctuation;

    }


}