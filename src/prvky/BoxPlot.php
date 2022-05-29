<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\HodnotyGrafu;
use BoxPlot\Data\SouborDat;

class BoxPlot extends Prvek
{
    private HodnotyGrafu $hodnotyGrafu;
    private int $vyska;
    private float $velikostJednotky;

    public function nakresli(HodnotyGrafu $hodnotyGrafu, SouborDat $souborDat): void
    {
        $this->hodnotyGrafu = $hodnotyGrafu;
        $this->vyska = $this->rozmery->grafVyska / 2;
        $this->velikostJednotky = $this->rozmery->grafSirka / max($hodnotyGrafu->osaMaximum - $hodnotyGrafu->osaMinimum, 1);
        $this->nakresliMedian($souborDat->vratMedian());
        $this->nakresliKrabici($souborDat->vrat1Kvartil(), $souborDat->vrat3Kvartil());
        $this->nakresliVous($souborDat->vrat1Kvartil(), $souborDat->vratMinimum());
        $this->nakresliVous($souborDat->vrat3Kvartil(), $souborDat->vratMaximum());
    }

    private function nakresliMedian(float $median): void
    {
        $x = $this->rozmery->grafLevyHorniBod->x + ($median - $this->hodnotyGrafu->osaMinimum) * $this->velikostJednotky;
        $bod1 = new Bod($x, $this->rozmery->grafStred->y + $this->vyska / 2);
        $bod2 = new Bod($x, $this->rozmery->grafStred->y - $this->vyska / 2);
        $this->obrazek->nakresliCaru($bod1, $bod2);
    }

    private function nakresliKrabici(float $kvartil1, float $kvartil3): void
    {
        $x1 = $this->rozmery->grafLevyHorniBod->x + ($kvartil1 - $this->hodnotyGrafu->osaMinimum) * $this->velikostJednotky;
        $x2 = $this->rozmery->grafLevyHorniBod->x + ($kvartil3 - $this->hodnotyGrafu->osaMinimum) * $this->velikostJednotky;
        $bod1 = new Bod($x1, $this->rozmery->grafStred->y + $this->vyska / 2);
        $bod2 = new Bod($x2, $this->rozmery->grafStred->y - $this->vyska / 2);
        $this->obrazek->nakresliObdelnik($bod1, $bod2);
    }

    private function nakresliVous(float $vnitrniHodnota, float $vnejsiHodnota): void
    {
        $xVnejsiHodnoty = $this->rozmery->grafLevyHorniBod->x + ($vnejsiHodnota - $this->hodnotyGrafu->osaMinimum) * $this->velikostJednotky;
        $xVnitrniHodnoty = $this->rozmery->grafLevyHorniBod->x + ($vnitrniHodnota - $this->hodnotyGrafu->osaMinimum) * $this->velikostJednotky;
        $bodSvisleCary1 = new Bod($xVnejsiHodnoty, $this->rozmery->grafStred->y + $this->vyska / 4);
        $bodSvisleCary2 = new Bod($xVnejsiHodnoty, $this->rozmery->grafStred->y - $this->vyska / 4);
        $bodVodorovneCary1 = new Bod($xVnejsiHodnoty, $this->rozmery->grafStred->y);
        $bodVodorovneCary2 = new Bod($xVnitrniHodnoty, $this->rozmery->grafStred->y);
        $this->obrazek->nakresliCaru($bodVodorovneCary1, $bodVodorovneCary2);
        $this->obrazek->nakresliCaru($bodSvisleCary1, $bodSvisleCary2);
    }
}