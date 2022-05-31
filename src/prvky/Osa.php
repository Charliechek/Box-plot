<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\Rozmery;
use BoxPlot\Data\SouborDat;
use BoxPlot\Grafika\Obrazek;
use BoxPlot\Prvky\Prvek;

class Osa extends Prvek
{
    private int $y;

    public function nakresli(SouborDat $souborDat): void
    {
        $this->y = $this->rozmery->grafHorniOkraj + $this->rozmery->grafVyska;
        for (
            $hodnota = $this->hodnotyOsy->minimum; 
            $hodnota <= $this->hodnotyOsy->maximum; 
            $hodnota += $this->hodnotyOsy->nasobekJednotky
        ) {
            $this->nakresliZnacku($hodnota);
        }
    }
    
    private function nakresliZnacku(int $hodnota): void
    {
        $x = $this->vypocitejXProHodnotu($hodnota);
        $this->nakresliCarku($x);
        $this->napisHodnotu($x, $hodnota);
    }
    
    private function nakresliCarku(int $x): void
    {        
        $bod1 = new Bod($x, $this->y);
        $bod2 = new Bod($x, $this->y + 5);
        $this->obrazek->nakresliCaru($bod1, $bod2, sirka: 2, barva: Obrazek::BARVA_CERNA);
    }
    
    private function napisHodnotu(int $x, int $hodnota): void
    {
        $bod = new Bod($x, $this->y + Rozmery::VYSKA_OSY_PX / 2);
        $this->obrazek->napisCentrovanyText($bod, $hodnota, $this->rozmery->velikostPisma);
    }
}