<?php

require "vendor/autoload.php";

$data = [-42, -24, -19, -17, -16, -12, -7, -3, -1, 68];
// $data = [.1, .5, .7, .6, .4];
// $data = [0];
$data = [];
for ($i = 1; $i <= 10; $i++) {
    $data[] = rand(1, 100);
}

$graf = new BoxPlot\Graf(600, 200);
$graf->nactiHodnoty($data);
$graf->vytvorGraf();
$graf->ulozObrazek("boxplot.png");

?>

<img src="boxplot.png" alt="boxplot">