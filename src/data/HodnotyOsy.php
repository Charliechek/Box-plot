<?php

namespace BoxPlot\Data;

class HodnotyOsy
{
    private const NASOBKY_JEDNOTEK = [.1, .5, 1, 5, 10, 25, 50, 100];
    private const MAX_POCET_ZNACEK_OSY = 10;

    public readonly float $minimum;
    public readonly float $maximum;
    public readonly float $nasobekJednotky;

    public function __construct(SouborDat $souborDat)
    {
        $minimumDat = $souborDat->vratMinimum();
        $maximumDat = $souborDat->vratMaximum();
        $rozpetiDat = $maximumDat - $minimumDat;
        $this->nasobekJednotky = $this->vyberJednotku($rozpetiDat);
        $zaokrouhleneMinimum = $this->zaokrouhliNaNasobekJednotkyDolu($minimumDat);
        $this->minimum = (bccomp($zaokrouhleneMinimum, $minimumDat, 4) === 0)
            ? $zaokrouhleneMinimum - $this->nasobekJednotky
            : $zaokrouhleneMinimum
        ;
        $zaokrouhleneMaximum = $this->zaokrouhliNaNasobekJednotkyNahoru($maximumDat);
        $this->maximum = (bccomp($zaokrouhleneMaximum, $maximumDat, 4) === 0)
            ? $zaokrouhleneMaximum + $this->nasobekJednotky
            : $zaokrouhleneMaximum
        ;
    }

    // vybere jednotku osy tak, aby na ose nebyl více než maximální počet značek
    private function vyberJednotku(float $rozpeti): float
    {
        foreach (self::NASOBKY_JEDNOTEK as $nasobekJednotky) {
            if ($rozpeti / self::MAX_POCET_ZNACEK_OSY < $nasobekJednotky) {
                return $nasobekJednotky;
            }
        }
        return self::NASOBKY_JEDNOTEK[count(self::NASOBKY_JEDNOTEK) - 1];
    }

    function zaokrouhliNaNasobekJednotkyDolu(float $cislo): float
    {
        return floor($cislo / $this->nasobekJednotky) * $this->nasobekJednotky;
    }
    
    function zaokrouhliNaNasobekJednotkyNahoru(float $cislo): float
    {
        return ceil($cislo / $this->nasobekJednotky) * $this->nasobekJednotky;
    }
}