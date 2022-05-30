<?php

namespace BoxPlot\Data;

class HodnotyOsy
{
    private const NASOBKY_JEDNOTEK = [1, 5, 10, 25, 50, 100];
    private const MAX_POCET_ZNACEK_OSY = 10;

    public readonly float $minimum;
    public readonly float $maximum;
    public readonly int $nasobekJednotky;
    public readonly int $pocetZnacek;

    public function __construct(SouborDat $souborDat)
    {
        $minimumDat = $souborDat->vratMinimum();
        $maximumDat = $souborDat->vratMaximum();
        $rozpetiDat = $maximumDat - $minimumDat;
        $this->nasobekJednotky = $this->vyberJednotku($rozpetiDat);
        $this->minimum = $this->zaokrouhliNaNasobekDolu($minimumDat, $this->nasobekJednotky) - $this->nasobekJednotky;
        $this->maximum = $this->zaokrouhliNaNasobekNahoru($maximumDat, $this->nasobekJednotky) + $this->nasobekJednotky;
        $this->pocetZnacek = (($this->maximum - $this->minimum) / $this->nasobekJednotky) + 1;
    }

    // vybere jednotku osy tak, aby na ose nebyl více než maximální počet značek
    private function vyberJednotku(float $rozpeti): int
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