<?php

namespace App\Model;


class Word
{

    private string $word;
    private int $size;
    private int $punctuation;

    public function __construct(string $word)
    {
        $this->setWord($word);
        $this->setSize();
        $this->setPunctuation();
    }

    private function setPunctuation()
    {
        $this->punctuation = (new Punctuation())->definePunctuation($this->word);
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