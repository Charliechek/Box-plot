<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\HodnotyGrafu;
use BoxPlot\Data\Rozmery;
use BoxPlot\Data\SouborDat;
use BoxPlot\Prvky\Prvek;

class Osa extends Prvek
{
    private int $jednotka;
    private int $minimum;
    private int $maximum;
    private float $vzdalenostZnacek;

    public function nakresli(HodnotyGrafu $hodnotyGrafu, SouborDat $souborDat): void
    {
        $this->jednotka = $hodnotyGrafu->osaJednotka;
        $this->minimum = $hodnotyGrafu->osaMinimum;
        $this->maximum = $hodnotyGrafu->osaMaximum;
        $this->nakresliZnacky();
    }
    
    private function nakresliZnacky(): void
    {
        $pocetZnacek = (($this->maximum - $this->minimum) / $this->jednotka) + 1;
        $this->vzdalenostZnacek = $this->rozmery->grafSirka / max($pocetZnacek - 1, 1);
        for ($i = 0; $i < $pocetZnacek; $i++) {
            $this->nakresliZnacku($i);
        }
    }
    
    private function nakresliZnacku(int $poradiZnacky): void
    {
        $bod1 = new Bod(
            $this->rozmery->grafLevyHorniBod->x + $poradiZnacky * $this->vzdalenostZnacek,
            $this->rozmery->grafLevyHorniBod->y + $this->rozmery->grafVyska
        );
        $bod2 = new Bod(
            $bod1->x,
            $bod1->y + Rozmery::VYSKA_OSY_PX / 3
        );
        $cislo = $this->minimum + $poradiZnacky * $this->jednotka;
        $this->obrazek->nakresliCaru($bod1, $bod2);
        $this->obrazek->napisText($bod1, $cislo);
    }
}