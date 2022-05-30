<?php

namespace BoxPlot\Data;

use BoxPlot\Data\Bod;

class Rozmery
{
    public const OKRAJE_PX = 15;
    public const VYSKA_OSY_PX = 15; 
    private const MIN_VELIKOST_PISMA = 5;

    public readonly int $obrazekSirka;
    public readonly int $obrazekVyska;
    public readonly int $grafSirka;
    public readonly int $grafVyska;
    public readonly int $grafLevyOkraj;
    public readonly int $grafHorniOkraj;
    public readonly Bod $grafStred;
    public readonly int $velikostPisma;

    public function __construct(int $obrazekSirka, int $obrazekVyska)
    {
        $this->obrazekSirka = $obrazekSirka;
        $this->obrazekVyska = $obrazekVyska;
        $this->vypocitejRozmeryOblastiGrafu();
        $this->vypocitejVelikostPisma();
    }

    private function vypocitejRozmeryOblastiGrafu(): void
    {
        $this->grafLevyOkraj = self::OKRAJE_PX;
        $this->grafHorniOkraj = self::OKRAJE_PX;
        $this->grafSirka = $this->obrazekSirka - (self::OKRAJE_PX * 2);
        $this->grafVyska = $this->obrazekVyska - (self::OKRAJE_PX * 2) - self::VYSKA_OSY_PX;
        $this->grafStred = new Bod(
            $this->grafLevyOkraj + $this->grafSirka / 2,
            $this->grafHorniOkraj + $this->grafVyska / 2
        );
    }

    private function vypocitejVelikostPisma(): void
    {
        $velikostPisma = ceil($this->obrazekSirka / 50);
        $this->velikostPisma = max($velikostPisma, self::MIN_VELIKOST_PISMA);
    }
}