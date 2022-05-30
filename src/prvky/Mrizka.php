<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Prvky\Prvek;
use BoxPlot\Data\SouborDat;
use BoxPlot\Grafika\Obrazek;

class Mrizka extends Prvek
{
    private float $vzdalenostCar;

    public function nakresli(SouborDat $souborDat): void
    {
        $this->vzdalenostCar = $this->hodnotyOsy->nasobekJednotky * $this->jednotkaOsyVPixelech;
        for ($i = 1; $i < $this->hodnotyOsy->pocetZnacek - 1; $i++) {
            $this->nakresliCaru($i);
        }
    }

    private function nakresliCaru(int $poradiCary): void
    {
        $bod1 = new Bod(
            $this->rozmery->grafLevyOkraj + $poradiCary * $this->vzdalenostCar,
            $this->rozmery->grafHorniOkraj + $this->rozmery->grafVyska
        );
        $bod2 = new Bod($bod1->x, $this->rozmery->grafHorniOkraj);
        $this->obrazek->nakresliPrerusovanouCaru($bod1, $bod2, barva: Obrazek::BARVA_SEDA);
    }
}