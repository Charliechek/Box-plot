<?php

namespace BoxPlot;

use Exception;
use BoxPlot\Data\HodnotyGrafu;
use BoxPlot\Prvky\Telo;
use BoxPlot\Data\Rozmery;
use BoxPlot\Data\SouborDat;
use BoxPlot\Prvky\BoxPlot;
use BoxPlot\Prvky\Osa;

class Graf
{
    private Obrazek $obrazek;
    private Rozmery $rozmery;
    private SouborDat $souborDat;
    private array $prvky;

    public function __construct(int $sirka = 400, int $vyska = 200)
    {
        $this->rozmery = new Rozmery($sirka, $vyska);
        $this->obrazek = new Obrazek($sirka, $vyska);
    }
    
    public function nactiHodnoty(array $hodnoty): void
    {
        $this->souborDat = new SouborDat($hodnoty);
    }
    
    public function vytvorGraf(): void
    {
        if (!isset($this->souborDat)) {
            throw new Exception("Graf nelze vytvořit, protože mu nebyla přidělena žádná data.");
        }
        $this->vytvorPrvky();
        $this->nakresliPrvky();
    }
    
    private function vytvorPrvky(): void
    {
        $this->prvky = [
            new Telo($this->obrazek, $this->rozmery),
            new Osa($this->obrazek, $this->rozmery),
            new BoxPlot($this->obrazek, $this->rozmery)
        ];
    }

    private function nakresliPrvky(): void
    {
        $hodnotyGrafu = new HodnotyGrafu($this->souborDat);
        foreach ($this->prvky as $prvek) {
            $prvek->nakresli($hodnotyGrafu, $this->souborDat);
        }
    }

    public function ulozObrazek(string $nazevSouboru): void
    {
        $this->obrazek->ulozObrazek($nazevSouboru);
    }
}