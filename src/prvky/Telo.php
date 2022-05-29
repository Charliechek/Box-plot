<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\HodnotyGrafu;
use BoxPlot\Data\SouborDat;

class Telo extends Prvek
{
    public function nakresli(HodnotyGrafu $hodnotyGrafu, SouborDat $souborDat): void
    {
        $bod1 = new Bod(
            $this->rozmery->grafLevyHorniBod->x, 
            $this->rozmery->grafLevyHorniBod->y
        );
        $bod2 = new Bod( 
            $this->rozmery->grafLevyHorniBod->x + $this->rozmery->grafSirka, 
            $this->rozmery->grafLevyHorniBod->y + $this->rozmery->grafVyska
        ); 
        $this->obrazek->nakresliObdelnik($bod1, $bod2);
    }
}
