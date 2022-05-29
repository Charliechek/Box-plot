<?php

namespace BoxPlot\Data;

use BoxPlot\Data\Bod;

class Rozmery
{
    public const OKRAJE_PX = 10;
    public const VYSKA_OSY_PX = 10; 

    public readonly int $sirka;
    public readonly int $vyska;
    public readonly Bod $grafLevyHorniBod;
    public readonly Bod $grafStred;
    public readonly int $grafSirka;
    public readonly int $grafVyska;

    public function __construct(int $sirka, int $vyska)
    {
        $this->sirka = $sirka;
        $this->vyska = $vyska;
        $this->vypocitejRozmeryOblastiGrafu();
    }

    private function vypocitejRozmeryOblastiGrafu(): void
    {
        $this->grafLevyHorniBod = new Bod(
            self::OKRAJE_PX,
            self::OKRAJE_PX
        );
        $this->grafSirka = $this->sirka - (self::OKRAJE_PX * 2);
        $this->grafVyska = $this->vyska - (self::OKRAJE_PX * 2) - self::VYSKA_OSY_PX;
        $this->grafStred = new Bod(
            $this->grafLevyHorniBod->x + $this->grafSirka / 2,
            $this->grafLevyHorniBod->y + $this->grafVyska / 2
        );
    }
}