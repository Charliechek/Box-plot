<?php

namespace BoxPlot\Data;

class Bod
{
    public readonly int $x;
    public readonly int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}