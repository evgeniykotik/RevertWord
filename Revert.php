<?php

define("SYMBOLS", "/^[a-zA-Zа-яА-Я0-9]/i");

class Revert
{
    function isSymbol($symbol)
    {
        return preg_match(SYMBOLS, $symbol);
    }

    function isBigLetter($symbol)
    {
        return $symbol == strtoupper($symbol);
    }

    function revertWordInArray(&$array, $first, $last)
    {
        for ($f = $first, $l = $last; $f <= $l; $f++, $l--) {
            $isFirstBig = $this->isBigLetter($array[$f]);
            $isLastBig = $this->isBigLetter($array[$l]);
            $temp = $array[$l];
            $array[$l] = $isLastBig ? strtoupper($array[$f]) : strtolower($array[$f]);
            $array[$f] = $isFirstBig ? strtoupper($temp) : strtolower($temp);
        }
    }

    function revertCharacters(string $string)
    {
        $charArray = str_split($string);
        $firstLetterInWordIndex = null;
        $lastLetterInWordIndex = null;
        $count = count($charArray);
        for ($i = 0; $i < $count; $i++) {
            if ($this->isSymbol($charArray[$i])) {
                if ($firstLetterInWordIndex === null) {
                    $firstLetterInWordIndex = $i;
                } else {
                    $lastLetterInWordIndex = $i;
                }
            } else {
                if ($firstLetterInWordIndex !== null && $lastLetterInWordIndex !== null) {
                    $this->revertWordInArray($charArray, $firstLetterInWordIndex, $lastLetterInWordIndex);
                    $firstLetterInWordIndex = null;
                    $lastLetterInWordIndex = null;
                }
            }
        }
        if ($firstLetterInWordIndex !== null && $lastLetterInWordIndex !== null) {
            $this->revertWordInArray($charArray, $firstLetterInWordIndex, $lastLetterInWordIndex);
        }
        return implode('', $charArray);
    }
}

