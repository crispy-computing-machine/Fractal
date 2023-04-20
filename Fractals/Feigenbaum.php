<?php

namespace Fractals;
class Feigenbaum extends Fractal {
    private $r;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax, $r) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
        $this->r = $r;
    }

    protected function calculatePixel($x, $y) {
        $real = $this->xmin + ($x / $this->width) * ($this->xmax - $this->xmin);
        $imag = $this->ymin + ($y / $this->height) * ($this->ymax - $this->ymin);

        $zr = $real;
        $zi = $imag;
        $i = 0;

        while ($i < $this->max_iterations) {
            $tmp = $zr * $zr - $zi * $zi + $this->r;
            $zi = 2 * $zr * $zi;
            $zr = $tmp;

            $zr = abs($zr);
            $zi = abs($zi);

            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;

            if ($zr2 + $zi2 > 4) {
                return $i == $this->max_iterations ? 0 : 255 - (int)(log($i) * 10);
            }

            $i++;
        }

        return 0;
    }
}
