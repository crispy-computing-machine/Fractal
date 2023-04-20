<?php

use Fractals\BurningShip;
use Fractals\Feigenbaum;
use Fractals\GoldenDragon;
use Fractals\Julia;
use Fractals\Mandelbrot;
use Fractals\Tree;

$start_time = microtime(true);
$examples = __DIR__ . DIRECTORY_SEPARATOR . 'examples' . DIRECTORY_SEPARATOR;

$loader = require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$height = 640;
$width = 480;

$fractal = new Mandelbrot($height, $width, 100, -2, 1, -1, 1);
$fractal->createImage($examples . 'mandelbrot.png');

$fractal = new Julia($height, $width, 300, -1.5, 1.5, -1.5, 1.5, -0.70176, -0.3842, 1, 0.1, 0.1);
$fractal->createImage($examples . 'julia.png');

$fractal = new BurningShip($height, $width, 100, -2, 1, -2, 2);
$fractal->createImage($examples . 'burning_ship.png');

$fractal = new Tree($height, $width, 11, -2, 2, -2, 2, M_PI / 4, 0.5, 1);
$fractal->createImage($examples . 'tree.png');

$fractal = new Feigenbaum($height, $width, 1000, 3, 4, -1, 1);
$fractal->createImage($examples . 'feigenbaum.png');

$fractal = new GoldenDragon($height, $width, 15, -2, 2, -2, 2);
$fractal->createImage($examples . 'golden_dragon.png');

// Calculating the script execution time
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo ' Execution time of script = ' . $execution_time . ' sec';