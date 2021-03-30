<?php


namespace App\Controllers;
use App\Model\Word;


class HandleWord
{



    public function __construct()
    {

    }

    public static function arrayToString(array $words) :string
    {
        return implode("",$words);
    }

    public function clean(string $word): string
    {
       return strtolower(preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $word ) ));

    }

}