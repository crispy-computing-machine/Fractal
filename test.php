<?php

use Fractals\BurningShip;
use Fractals\Feigenbaum;
use Fractals\GoldenDragon;
use Fractals\Julia;
use Fractals\Mandelbrot;
use Fractals\Tree;

$start_time = microtime(true);

$loader = require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$height = 640;
$width = 480;


$fractal = new Mandelbrot($height, $width, 100, -2, 1, -1, 1);
$fractal->createImage("mandelbrot.png");

$fractal = new Julia($height, $width, 300, -1.5, 1.5, -1.5, 1.5, -0.70176, -0.3842, 1, 0.1, 0.1);
$fractal->createImage("julia.png");

$fractal = new BurningShip($height, $width, 100, -2, 1, -2, 2);
$fractal->createImage("burning_ship.png");

$fractal = new Tree($height, $width, 11, -2, 2, -2, 2, M_PI / 4, 0.5, 1);
$fractal->createImage("tree.png");

$fractal = new Feigenbaum($height, $width, 100, 3, 4, -1, 1, 3.7);
$fractal->createImage("feigenbaum.png");

$fractal = new GoldenDragon($height, $width, 15, -2, 2, -2, 2);
$fractal->createImage("golden_dragon.png");

// Calculating the script execution time
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo " Execution time of script = " . $execution_time . " sec";