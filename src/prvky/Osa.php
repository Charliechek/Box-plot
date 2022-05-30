<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\Rozmery;
use BoxPlot\Data\SouborDat;
use BoxPlot\Grafika\Obrazek;
use BoxPlot\Prvky\Prvek;

class Osa extends Prvek
{
    private float $vzdalenostZnacek;

    public function nakresli(SouborDat $souborDat): void
    {
        $this->vzdalenostZnacek = $this->hodnotyOsy->nasobekJednotky * $this->jednotkaOsyVPixelech;
        for ($i = 0; $i < $this->hodnotyOsy->pocetZnacek; $i++) {
            $this->nakresliZnacku($i);
        }
    }
    
    private function nakresliZnacku(int $poradiZnacky): void
    {
        $bodCary1 = new Bod(
            $this->rozmery->grafLevyOkraj + $poradiZnacky * $this->vzdalenostZnacek,
            $this->rozmery->grafHorniOkraj + $this->rozmery->grafVyska
        );
        $bodCary2 = new Bod($bodCary1->x, $bodCary1->y + 5);
        $bodTextu = new Bod($bodCary1->x, $bodCary1->y + Rozmery::VYSKA_OSY_PX / 2);
        $cislo = $this->hodnotyOsy->minimum + $poradiZnacky * $this->hodnotyOsy->nasobekJednotky;
        $this->obrazek->nakresliCaru($bodCary1, $bodCary2, sirka: 2, barva: Obrazek::BARVA_CERNA);
        $this->obrazek->napisCentrovanyText($bodTextu, $cislo, $this->rozmery->velikostPisma);
    }
}