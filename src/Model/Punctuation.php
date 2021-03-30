<?php


namespace App\Model;


use App\Repository\WordRepository;

class Punctuation
{


    public function definePunctuation(String $word)
    {
        $lettersPunctuation = WordRepository::getLetterPunctuation();
        $wordIntoArray = $this->wordToArray($word);
        foreach ($word as $letter) {
            foreach ($lettersPunctuation as $letterPunctuation) {
                var_dump($letterPunctuation);
                var_dump($letter);
            }
        }
    }

    private function wordToArray(): array
    {
        return str_split($this->word);
    }
}