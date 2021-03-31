<?php


namespace App\Controllers;


class HandleWord
{

    public function __construct(){}

    public static function arrayObjectToString(\ArrayObject $arr): string
    {
        $words = "";
        foreach($arr as $word){
            $words .= $word->getWord();
        }
        return $words;
    }

    public static function wordToArray($word): array
    {
        return str_split(strtoupper($word));
    }

    public function clean(string $word): string
    {
        return strtolower(preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $word)));

    }

}