<?php

namespace BoxPlot;

use GdImage;
use BoxPlot\Data\Bod;

class Obrazek
{
    public const BARVA_BILA = "bila";
    public const BARVA_CERNA = "cerna";
    public const BARVA_SEDA = "seda";

    public readonly GdImage $platno;
    public readonly array $barvy;
    private int $vyska;
    private int $sirka;

    public function __construct(int $sirka, int $vyska)
    {
        $this->sirka = $sirka;
        $this->vyska = $vyska; 
        $this->platno = imagecreatetruecolor($sirka, $vyska);
        $this->vytvorBarvy();
        $this->vyplnPlatnoBarvou();
    }

    private function vyplnPlatnoBarvou(): void
    {
        imagefilledrectangle(
            $this->platno, 
            0, 
            0, 
            $this->sirka, 
            $this->vyska, 
            $this->barvy[self::BARVA_BILA]
        );
    }

    private function vytvorBarvy(): void
    {
        $this->barvy = [
            self::BARVA_BILA => imagecolorallocate($this->platno, 255, 255, 255),
            self::BARVA_CERNA => imagecolorallocate($this->platno, 0, 0, 0),
            self::BARVA_SEDA => imagecolorallocate($this->platno, 100, 100, 100)
        ];
    }

    public function ulozObrazek(string $nazevSouboru): void
    {
        imagepng($this->platno, $nazevSouboru);
    }

    public function nakresliCaru(Bod $bod1, Bod $bod2): void
    {
        imageline($this->platno, $bod1->x, $bod1->y, $bod2->x, $bod2->y, $this->barvy[self::BARVA_CERNA]);
    }
    
    public function napisText(Bod $bod, string $text): void
    {
        imagestring($this->platno, 4, $bod->x, $bod->y, $text, $this->barvy[self::BARVA_CERNA]);
    }

    public function nakresliObdelnik(Bod $bod1, Bod $bod2): void
    {
        imagerectangle($this->platno, $bod1->x, $bod1->y, $bod2->x, $bod2->y, $this->barvy[self::BARVA_CERNA]);
    }
}