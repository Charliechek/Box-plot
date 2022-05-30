<?php

namespace BoxPlot\Prvky;

use BoxPlot\Data\Bod;
use BoxPlot\Data\SouborDat;

class Telo extends Prvek
{
    public function nakresli(SouborDat $souborDat): void
    {
        $bod1 = new Bod(
            $this->rozmery->grafLevyOkraj, 
            $this->rozmery->grafHorniOkraj
        );
        $bod2 = new Bod( 
            $this->rozmery->grafLevyOkraj + $this->rozmery->grafSirka, 
            $this->rozmery->grafHorniOkraj + $this->rozmery->grafVyska
        ); 
        $this->obrazek->nakresliObdelnik($bod1, $bod2);
    }
}
