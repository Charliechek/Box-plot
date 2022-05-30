<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Rozmery;
use BoxPlot\Data\SouborDat;
use BoxPlot\Data\HodnotyOsy;
use BoxPlot\Grafika\Obrazek;

abstract class Prvek
{
    protected Obrazek $obrazek;
    protected Rozmery $rozmery;
    protected HodnotyOsy $hodnotyOsy;
    protected float $jednotkaOsyVPixelech;

    public function __construct(Obrazek $obrazek, Rozmery $rozmery, HodnotyOsy $hodnotyOsy)
    {
        $this->obrazek = $obrazek;
        $this->rozmery = $rozmery;
        $this->hodnotyOsy = $hodnotyOsy;
        $this->jednotkaOsyVPixelech = $this->rozmery->grafSirka / max($this->hodnotyOsy->maximum - $this->hodnotyOsy->minimum, 1);
    }

    abstract public function nakresli(SouborDat $souborDat): void;
}