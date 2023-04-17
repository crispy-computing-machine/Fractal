# Examples

```php
$fractal = new Fractal(640, 480, 100, -2, 1, -1, 1);
$fractal->createImage("mandelbrot.png");

$fractal = new Mandelbrot(640, 480, 100, -2, 1, -1, 1);
$fractal->createImage("mandelbrot.png");

$fractal = new Julia(640, 480, 100, -1.5, 1.5, -1.5, 1.5, -0.70176, -0.3842);
$fractal->createImage("julia.png");

$fractal = new BurningShip(640, 480, 100, -2, 1, -2, 2);
$fractal->createImage("burning_ship.png");

$fractal = new Tree(640, 480, 100, -2, 2, -2, 2, M_PI / 6);
$fractal->createImage("tree.png");

$fractal = new Feigenbaum(640, 480, 1000, 3, 4, -1, 1, 3.7);
$fractal->createImage("feigenbaum.png");

$fractal = new GoldenDragon(640, 480, 100, -2, 2, -2, 2);
$fractal->createImage("golden_dragon.png");
