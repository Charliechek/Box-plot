<?php

namespace BoxPlot\Data;

class HodnotyOsy
{
    private const NASOBKY_JEDNOTEK = [1, 5, 10, 25, 50, 100];
    private const MAX_POCET_ZNACEK_OSY = 10;

    public readonly float $minimum;
    public readonly float $maximum;
    public readonly int $nasobekJednotky;

    public function __construct(SouborDat $souborDat)
    {
        $minimumDat = $souborDat->vratMinimum();
        $maximumDat = $souborDat->vratMaximum();
        $rozpetiDat = $maximumDat - $minimumDat;
        $this->nasobekJednotky = $this->vyberJednotku($rozpetiDat);
        $zaokrouhleneMinimum = $this->zaokrouhliNaNasobekDolu($minimumDat, $this->nasobekJednotky);
        $this->minimum = ($zaokrouhleneMinimum == $minimumDat) 
            ? $zaokrouhleneMinimum - $this->nasobekJednotky 
            : $zaokrouhleneMinimum
        ;
        $zaokrouhleneMaximum = $this->zaokrouhliNaNasobekNahoru($maximumDat, $this->nasobekJednotky);
        $this->maximum = ($zaokrouhleneMaximum == $maximumDat)
            ? $zaokrouhleneMaximum + $this->nasobekJednotky
            : $zaokrouhleneMaximum
        ;
    }

    // vybere jednotku osy tak, aby na ose nebyl více než maximální počet značek
    private function vyberJednotku(int $rozpeti): int
    {
        foreach (self::NASOBKY_JEDNOTEK as $nasobekJednotky) {
            if ($rozpeti / self::MAX_POCET_ZNACEK_OSY < $nasobekJednotky) {
                return $nasobekJednotky;
            }
        }
        return self::NASOBKY_JEDNOTEK[count(self::NASOBKY_JEDNOTEK) - 1];
    }

    function zaokrouhliNaNasobekDolu(float $cislo, int $nasobek): int
    {
        return floor($cislo / $nasobek) * $nasobek;
    }
    
    function zaokrouhliNaNasobekNahoru(float $cislo, int $nasobek): int
    {
        return ceil($cislo / $nasobek) * $nasobek;
    }
}