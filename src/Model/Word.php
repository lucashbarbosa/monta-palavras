<?php
declare(strict_types=1);
namespace App\Model;


use App\Repository\WordRepository;

class Word
{

    private string $word;
    private int $size;
    private int $punctuation;

    public function __construct(string $word,  array $lettersPunctuation, int $bonusPosition,)
    {
        $this->setWord($word);
        $this->setSize();
        $this->setPunctuation($bonusPosition, $lettersPunctuation);
    }

    private function setPunctuation(int $bonusPosition, array $lettersPunctuation)
    {
        $this->punctuation = (new Punctuation())->definePunctuation($this->word, $lettersPunctuation, $bonusPosition);
    }
    private function setSize()
    {
        $this->size = strlen($this->word);
    }

    public function getSize():int
    {
        return $this->size;
    }
    public function getPunctuation():int
    {
        return $this->punctuation;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function setWord(string $word): void
    {
        $this->word = $word;
    }


}