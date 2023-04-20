<?php

namespace Fractals;

class Julia extends Fractal {
    private $cr;
    private $ci;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax, $cr, $ci) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
        $this->cr = $cr;
        $this->ci = $ci;
    }

    protected function calculatePixel($x, $y) {
        $real = $this->xmin + ($x / $this->width) * ($this->xmax - $this->xmin);
        $imag = $this->ymin + ($y / $this->height) * ($this->ymax - $this->ymin);

        $zr = $real;
        $zi = $imag;
        $zr2 = $zi2 = $i = 0;

        while ($i < $this->max_iterations && ($zr2 + $zi2) < 4) {
            $zi = 2 * $zr * $zi + $this->ci;
            $zr = $zr2 - $zi2 + $this->cr;
            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;
            $i++;
        }

        return $i == $this->max_iterations ? 0 : 255 - (int)(log($i) * 10);
    }
}
