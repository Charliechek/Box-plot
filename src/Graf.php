<?php

namespace BoxPlot;

use Exception;
use BoxPlot\Prvky\Osa;
use BoxPlot\Prvky\Telo;
use BoxPlot\Data\Rozmery;
use BoxPlot\Prvky\BoxPlot;
use BoxPlot\Data\SouborDat;
use BoxPlot\Data\HodnotyOsy;
use BoxPlot\Grafika\Obrazek;
use BoxPlot\Grafika\ObrazekGD;
use BoxPlot\Prvky\Mrizka;

class Graf
{
    private Obrazek $obrazek;
    private Rozmery $rozmery;
    private SouborDat $souborDat;
    private HodnotyOsy $hodnotyOsy;
    private array $prvky;

    public function __construct(int $sirka = 400, int $vyska = 200)
    {
        $this->rozmery = new Rozmery($sirka, $vyska);
        $this->obrazek = new ObrazekGD($sirka, $vyska);
    }
    
    public function nactiHodnoty(array $hodnoty): void
    {
        $this->souborDat = new SouborDat($hodnoty);
        $this->hodnotyOsy = new HodnotyOsy($this->souborDat);
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
        $tridyPrvku = [Telo::class, Osa::class, Mrizka::class, BoxPlot::class];
        foreach ($tridyPrvku as $tridaPrvku) {
            $this->prvky[] = new $tridaPrvku($this->obrazek, $this->rozmery, $this->hodnotyOsy);
        }
    }

    private function nakresliPrvky(): void
    {
        foreach ($this->prvky as $prvek) {
            $prvek->nakresli($this->souborDat);
        }
    }

    public function ulozObrazek(string $nazevSouboru): void
    {
        $this->obrazek->ulozObrazekPNG($nazevSouboru);
    }
    
    public function vykresliObrazek(): void
    {
        $this->obrazek->vykresliObrazekPNG();
    }
}