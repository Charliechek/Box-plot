<?php

namespace BoxPlot\Data;

use Exception;

class SouborDat
{
    private array $hodnoty;
    private int $pocetHodnot;

    public function __construct(array $hodnoty)
    {
        if ($hodnoty === []) {
            throw new Exception("Pole dat neobsahuje žádnou hodnotu.");
        }
        if (!$this->obsahujePoleCiselneHodnoty($hodnoty)) {
            throw new Exception("Pole dat obsahuje jiné než číselné hodnoty.");
        }
        sort($hodnoty);
        $this->hodnoty = $hodnoty;
        $this->pocetHodnot = count($hodnoty);
    }

    private function obsahujePoleCiselneHodnoty(array $pole): bool
    {
        foreach($pole as $hodnota) {
            if (!is_numeric($hodnota)) {
                return false;
            }
        }
        return true;
    }

    public function vratMedian(): float
    {
        if (!$this->jeSudeCislo($this->pocetHodnot)) {
            return $this->hodnoty[ceil($this->pocetHodnot / 2) - 1];
        }
        $cisloPodStredem = $this->hodnoty[($this->pocetHodnot / 2) - 1];
        $cisloNadStredem = $this->hodnoty[$this->pocetHodnot / 2];
        return ($cisloPodStredem + $cisloNadStredem) / 2;
    }

    private function jeSudeCislo(int $cislo): bool
    {
        return $cislo % 2 === 0;
    }

    public function vrat1Kvartil(): float
    {
        $poradiCisla = ceil($this->pocetHodnot * 1/4);
        return $this->hodnoty[$poradiCisla - 1];
    }
    
    public function vrat3Kvartil(): float
    {
        $poradiCisla = ceil($this->pocetHodnot * 3/4);
        return $this->hodnoty[$poradiCisla - 1];
    }

    public function vratMaximum(): float
    {
        return max($this->hodnoty);
    }
    
    public function vratMinimum(): float
    {
        return min($this->hodnoty);
    }
}