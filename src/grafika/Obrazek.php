<?php

namespace BoxPlot\Grafika;

use BoxPlot\Data\Bod;

interface Obrazek
{
    public const BARVA_BILA = "bila";
    public const BARVA_CERNA = "cerna";
    public const BARVA_SEDA = "seda";
    public const BARVA_CERVENA = "cervena";

    public function __construct(int $sirka, int $vyska);

    public function ulozObrazekPNG(string $nazevSouboru): void;

    public function vykresliObrazekPNG(): void;

    public function nakresliCaru(Bod $bod1, Bod $bod2, int $sirka = 1, string $barva = self::BARVA_CERNA): void;

    public function nakresliPrerusovanouCaru(Bod $bod1, Bod $bod2, int $sirka = 1, string $barva = self::BARVA_CERNA): void;

    public function nakresliObdelnik(Bod $bod1, Bod $bod2, int $sirka = 1, string $barva = self::BARVA_CERNA): void;

    public function napisText(Bod $bod, string $text, int $velikost = 12, string $barva = self::BARVA_CERNA): void;

    public function napisCentrovanyText(Bod $bod, string $text, int $velikost = 12, string $barva = self::BARVA_CERNA): void;

}