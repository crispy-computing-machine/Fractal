<?php

namespace Fractals;

class Tree extends Fractal {
    private $angle;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax, $angle) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
        $this->angle = $angle;
    }

    protected function calculatePixel($x, $y) {
        $real = $this->xmin + ($x / $this->width) * ($this->xmax - $this->xmin);
        $imag = $this->ymin + ($y / $this->height) * ($this->ymax - $this->ymin);

        $zr = $real;
        $zi = $imag;
        $i = 0;

        while ($i < $this->max_iterations && abs($zr) < 10 && abs($zi) < 10) {
            $tmp = $zr * cos($this->angle) + $zi * sin($this->angle);
            $zi = $zr * sin($this->angle) - $zi * cos($this->angle);
            $zr = $tmp;

            $zr = abs($zr);
            $zi = abs($zi);

            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;

            $zr = $zr2 - $zi2 + $real;
            $zi = 2 * $zr * $zi + $imag;

            $i++;
        }

        return $i == $this->max_iterations ? 0 : 255 - (int)(log($i) * 10);
    }
}
