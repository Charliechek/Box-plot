<?php

namespace BoxPlot\Grafika;

use GdImage;
use BoxPlot\Data\Bod;

class ObrazekGD implements Obrazek
{
    private const FONT_ARIAL = __DIR__ . "/fonty/arial.ttf";

    public readonly array $barvy;
    private readonly GdImage $platno;
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
            self::BARVA_SEDA => imagecolorallocate($this->platno, 150, 150, 150),
            self::BARVA_CERVENA => imagecolorallocate($this->platno, 255, 0, 0)
        ];
    }

    public function ulozObrazekPNG(string $nazevSouboru): void
    {
        imagepng($this->platno, $nazevSouboru);
    }

    public function vykresliObrazekPNG(): void
    {
        imagepng($this->platno);
    }

    public function nakresliCaru(Bod $bod1, Bod $bod2, int $sirka = 1, string $barva = self::BARVA_CERNA): void
    {
        $this->nastavSirkuCary($sirka);
        imageline($this->platno, $bod1->x, $bod1->y, $bod2->x, $bod2->y, $this->barvy[$barva]);
    }
    
    public function nakresliPrerusovanouCaru(Bod $bod1, Bod $bod2, int $sirka = 1, string $barva = self::BARVA_CERNA, int $mezeraPX = 5): void
    {
        $this->nastavSirkuCary($sirka);
        $stylCary = [...array_fill(0, $mezeraPX, $this->barvy[$barva]), ...array_fill($mezeraPX, $mezeraPX, IMG_COLOR_TRANSPARENT)];
        imagesetstyle($this->platno, $stylCary);
        imageline($this->platno, $bod1->x, $bod1->y, $bod2->x, $bod2->y, IMG_COLOR_STYLED);
    }

    public function nakresliObdelnik(Bod $bod1, Bod $bod2, int $sirka = 1, string $barva = self::BARVA_CERNA): void
    {
        $this->nastavSirkuCary($sirka);
        imagerectangle($this->platno, $bod1->x, $bod1->y, $bod2->x, $bod2->y, $this->barvy[$barva]);
    }

    private function nastavSirkuCary(int $sirka): void
    {
        imagesetthickness($this->platno, $sirka);
    }

    public function napisText(Bod $bod, string $text, int $velikost = 12, string $barva = self::BARVA_CERNA): void
    {
        imagettftext($this->platno, $velikost, 0, $bod->x, $bod->y, $this->barvy[$barva], self::FONT_ARIAL, $text);
    }

    public function napisCentrovanyText(Bod $bod, string $text, int $velikost = 12, string $barva = self::BARVA_CERNA): void
    {
        $rozmeryTextu = imageftbbox($velikost, 0, self::FONT_ARIAL, $text);
        $sirkaTextu = $rozmeryTextu[4] - $rozmeryTextu[0];
        $vyskaTextu = $rozmeryTextu[5] - $rozmeryTextu[1];
        $upravenyBod = new Bod(
            $bod->x - $sirkaTextu / 2,
            $bod->y - $vyskaTextu
        );
        $this->napisText($upravenyBod, $text, $velikost, $barva);
    }
}