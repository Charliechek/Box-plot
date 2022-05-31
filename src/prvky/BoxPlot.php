<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\SouborDat;
use BoxPlot\Grafika\Obrazek;

class BoxPlot extends Prvek
{
    private const SIRKA_CARY = 2;

    private int $vyska;

    public function nakresli(SouborDat $souborDat): void
    {
        $this->vyska = $this->rozmery->grafVyska / 2;
        $this->nakresliVous($souborDat->vrat1Kvartil(), $souborDat->vratMinimum());
        $this->nakresliVous($souborDat->vrat3Kvartil(), $souborDat->vratMaximum());
        $this->nakresliKrabici($souborDat->vrat1Kvartil(), $souborDat->vrat3Kvartil());
        $this->nakresliMedian($souborDat->vratMedian());
    }

    private function nakresliMedian(float $median): void
    {
        $x = $this->vypocitejXProHodnotu($median);
        $bod1 = new Bod($x, $this->rozmery->grafStred->y + $this->vyska / 2);
        $bod2 = new Bod($x, $this->rozmery->grafStred->y - $this->vyska / 2);
        $this->obrazek->nakresliCaru($bod1, $bod2, self::SIRKA_CARY, barva: Obrazek::BARVA_CERVENA);
    }

    private function nakresliKrabici(float $kvartil1, float $kvartil3): void
    {
        $x1 = $this->vypocitejXProHodnotu($kvartil1);
        $x2 = $this->vypocitejXProHodnotu($kvartil3);
        $bod1 = new Bod($x1, $this->rozmery->grafStred->y + $this->vyska / 2);
        $bod2 = new Bod($x2, $this->rozmery->grafStred->y - $this->vyska / 2);
        $this->obrazek->nakresliObdelnik($bod1, $bod2, self::SIRKA_CARY);
    }

    private function nakresliVous(float $vnitrniHodnota, float $vnejsiHodnota): void
    {
        $xVnejsiHodnoty = $this->vypocitejXProHodnotu($vnejsiHodnota);
        $xVnitrniHodnoty = $this->vypocitejXProHodnotu($vnitrniHodnota);
        $bodSvisleCary1 = new Bod($xVnejsiHodnoty, $this->rozmery->grafStred->y + $this->vyska / 4);
        $bodSvisleCary2 = new Bod($xVnejsiHodnoty, $this->rozmery->grafStred->y - $this->vyska / 4);
        $bodVodorovneCary1 = new Bod($xVnejsiHodnoty, $this->rozmery->grafStred->y);
        $bodVodorovneCary2 = new Bod($xVnitrniHodnoty, $this->rozmery->grafStred->y);
        $this->obrazek->nakresliCaru($bodVodorovneCary1, $bodVodorovneCary2, self::SIRKA_CARY);
        $this->obrazek->nakresliCaru($bodSvisleCary1, $bodSvisleCary2, self::SIRKA_CARY);
    }
}