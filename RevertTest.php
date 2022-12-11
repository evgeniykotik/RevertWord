<?php

use PHPUnit\Framework\TestCase;

require_once 'Revert.php';

class RevertTest extends TestCase
{
    public function testIsSymbol()
    {
        $revert = new Revert();
        $this->assertEquals(false, $revert->isSymbol("@"));
        $this->assertEquals(true, $revert->isSymbol("a"));
    }

    public function testIsBigLetter()
    {
        $revert = new Revert();
        $this->assertEquals(true, $revert->isBigLetter("B"));
        $this->assertEquals(false, $revert->isBigLetter("d"));
    }

    public function testRevertWord()
    {
        $revert = new Revert();
        $array = ['T', 'r', 'u', 'e'];
        $revert->revertWordInArray($array, 0, 3);
        $this->assertEquals(['E','u','r','t'], $array);
    }

    public function testRevertCharacters()
    {
        $revert = new Revert();
        $this->assertEquals("@@  Hello World!!", $revert->revertCharacters("@@  Olleh Dlrow!!"));
    }
}