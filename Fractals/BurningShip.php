<?php

namespace Fractals;

class BurningShip extends Fractal {
    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
    }

    protected function calculatePixel($x, $y) {
        $real = $this->xmin + ($x / $this->width) * ($this->xmax - $this->xmin);
        $imag = $this->ymin + ($y / $this->height) * ($this->ymax - $this->ymin);

        $zr = $zi = $zr2 = $zi2 = $i = 0;

        while ($i < $this->max_iterations && ($zr2 + $zi2) < 4) {
            $zr = abs($zr);
            $zi = abs($zi);
            $tmp = $zr2 - $zi2 + $real;
            $zi = abs(2 * $zr * $zi + $imag);
            $zr = $tmp;
            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;
            $i++;
        }

        return $i == $this->max_iterations ? 0 : 255 - (int)(log($i) * 10);
    }
}
