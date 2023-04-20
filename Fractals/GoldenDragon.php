<?php

namespace Fractals;

class GoldenDragon extends Fractal {
    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
    }

    protected function calculatePixel($x, $y) {
        $real = $this->xmin + ($x / $this->width) * ($this->xmax - $this->xmin);
        $imag = $this->ymin + ($y / $this->height) * ($this->ymax - $this->ymin);

        $zr = $real;
        $zi = $imag;
        $i = 0;

        while ($i < $this->max_iterations) {
            if ($zi < 0) {
                $zi = -$zi;
                $zr = 1 - $zr;
            }
            $tmp = $zi - $zr;
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
