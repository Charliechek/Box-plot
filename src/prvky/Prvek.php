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

    private float $jednotkaOsyVPixelech;

    public function __construct(Obrazek $obrazek, Rozmery $rozmery, HodnotyOsy $hodnotyOsy)
    {
        $this->obrazek = $obrazek;
        $this->rozmery = $rozmery;
        $this->hodnotyOsy = $hodnotyOsy;
        $this->jednotkaOsyVPixelech = $this->rozmery->grafSirka / ($this->hodnotyOsy->maximum - $this->hodnotyOsy->minimum);
    }

    abstract public function nakresli(SouborDat $souborDat): void;

    protected function vypocitejXProHodnotu(float $hodnota): int
    {
        return $this->rozmery->grafLevyOkraj + ($hodnota - $this->hodnotyOsy->minimum) * $this->jednotkaOsyVPixelech;
    }
}