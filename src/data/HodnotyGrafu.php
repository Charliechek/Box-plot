<?php

namespace BoxPlot\Data;

class HodnotyGrafu
{
    private const JEDNOTKY = [1, 5, 10, 15, 20, 50, 100];
    private const MAX_POCET_NA_OSE = 10;

    public readonly float $osaMinimum;
    public readonly float $osaMaximum;
    public readonly int $osaJednotka;

    public function __construct(SouborDat $souborDat)
    {
        $minimumDat = $souborDat->vratMinimum();
        $maximumDat = $souborDat->vratMaximum();
        $rozpetiDat = $maximumDat - $minimumDat;
        $this->osaJednotka = $this->vyberJednotku($rozpetiDat);
        $this->osaMinimum = $this->zaokrouhliNaNasobekDolu($minimumDat, $this->osaJednotka);
        $this->osaMaximum = $this->zaokrouhliNaNasobekNahoru($maximumDat, $this->osaJednotka);
    }

    // vybere jednotku osy tak, aby na ose nebyl více než maximální počet značek
    private function vyberJednotku(float $rozpeti): int
    {
        foreach (self::JEDNOTKY as $jednotka) {
            if ($rozpeti / self::MAX_POCET_NA_OSE < $jednotka) {
                return $jednotka;
            }
        }
        return self::JEDNOTKY[count(self::JEDNOTKY) - 1];
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