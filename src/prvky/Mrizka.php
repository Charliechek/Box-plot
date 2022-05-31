<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Prvky\Prvek;
use BoxPlot\Data\SouborDat;
use BoxPlot\Grafika\Obrazek;

class Mrizka extends Prvek
{
    public function nakresli(SouborDat $souborDat): void
    {
        $jednotkaMrizky = $this->hodnotyOsy->nasobekJednotky / 2;
        for (
            $i = $this->hodnotyOsy->minimum + $jednotkaMrizky;
            $i < $this->hodnotyOsy->maximum;
            $i += $jednotkaMrizky
        ) {
            $this->nakresliCaru($i);
        }
    }

    private function nakresliCaru(float $hodnota): void
    {
        $x = $this->vypocitejXProHodnotu($hodnota);
        $bod1 = new Bod($x, $this->rozmery->grafHorniOkraj);
        $bod2 = new Bod($x, $this->rozmery->grafHorniOkraj + $this->rozmery->grafVyska);
        $this->obrazek->nakresliPrerusovanouCaru($bod1, $bod2, barva: Obrazek::BARVA_SEDA);
    }
}