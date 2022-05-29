<?php

namespace BoxPlot\Prvky;

use BoxPlot\Obrazek;
use BoxPlot\Data\Rozmery;
use BoxPlot\Data\HodnotyGrafu;
use BoxPlot\Data\SouborDat;

abstract class Prvek
{
    protected Obrazek $obrazek;
    protected Rozmery $rozmery;

    public function __construct(Obrazek $obrazek, Rozmery $rozmery)
    {
        $this->obrazek = $obrazek;
        $this->rozmery = $rozmery;
    }

    abstract public function nakresli(HodnotyGrafu $hodnotyGrafu, SouborDat $souborDat): void;
}