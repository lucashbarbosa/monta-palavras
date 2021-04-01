<?php

namespace App\Resources;


use App\Controllers\HandleWord;
use App\Model\Word;


class App
{
    public function matchWords(string $input, array $words): \ArrayObject
    {
        $matches = new \ArrayObject();
        if(sizeof($words) > 0){
            foreach ($words as $word) {
                $pattern = "/\b([" . $input . "]+)\b/i";
                $word = (new HandleWord())->clean($word);
                preg_match_all($pattern, $word) ?
                    $matches->append(new Word($word)) :
                    false;
            }
        }

        return $matches;
    }

    public function findMatchNonUsedLetters(string $matchedInlineWords, $input): string|null
    {

        if(strlen($matchedInlineWords) > 0){
            var_dump($input);
            var_dump($matchedInlineWords);
            $pattern = "([" . $matchedInlineWords . "]+)";
            return preg_replace($pattern, "", $input, -1);
        }
        return null;

    }

    public function getRankedResult(\ArrayObject $matches): \ArrayObject
    {
        $arrayMatches = $matches->getArrayCopy();
        usort($arrayMatches, function ($match1, $match2) {
            $punctuation = $match2->getPunctuation() <=> $match1->getPunctuation();
            if ($punctuation == 0) {
                $size = $match1->getSize()  <=> $match2->getSize();
                if ($size == 0) {
                    return strnatcmp($match1->getWord(), $match2->getWord());
                }
                return $size;
            }
            return $punctuation;
        });
        return new \ArrayObject($arrayMatches);
    }


}