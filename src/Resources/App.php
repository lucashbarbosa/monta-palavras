<?php

namespace App\Resources;



use App\Controllers\HandleWord;
use App\Repository\WordRepository;

class App
{


    public function matchWords(String $input)
    {
        $matches = [];
        $words = WordRepository::load();
        foreach($words as $word){
            $pattern = "/\b([".$input."]+)\b/i";
            $word =  (new HandleWord())->clean($word);
            preg_match_all($pattern, $word) ? $matches[] = $word  : false;

        }
        return $matches;
    }

    public function nonUsedLetters(string $matchedInlineWords, $input){
        $pattern = "([".$matchedInlineWords."]+)";

        return preg_replace($pattern, "", $input, -1);

    }
}