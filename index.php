<?php

require "vendor/autoload.php";

$data = [-42, -24, -19, -17, -16, -12, -7, -3, -1, 68];

$graf = new BoxPlot\Graf(600, 200);
$graf->nactiHodnoty($data);
$graf->vytvorGraf();
$graf->ulozObrazek("boxplot.png");

?>

<img src="boxplot.png" alt="boxplot">